<?php

namespace App\Services\User;

use Illuminate\Support\Facades\DB;

class Service
{
    public function workerStore($data)
    {
        $name = $data['name'];
        $parent_loc = $data['parent_loc'];
        $createdtime = date("Y-m-d H:i:s") . '.0';
        return DB::connection('sigur')->table('personal')
            ->insertGetId([
                'PARENT_ID' => $parent_loc,
                'TYPE' => 'EMP',
                'STATUS' => 'AVAILABLE',
                'CREATEDTIME' => $createdtime,
                'NAME' => DB::raw("CAST(CONVERT('$name' USING latin1) AS binary)"),
            ]);
    }

    public function workerCodeStore($data)
    {
        $codekey = '20'.$data['parent_loc'].$data['new_id'].'000000';
        
        DB::connection('sigur')->table('personal')
            ->where('ID', $data['new_id'])
            ->update([
                'CODEKEY_DISP_FORMAT' => 'W34',
                'CODEKEY' => hex2bin($codekey),
                'CODEKEYTIME' => date("Y-m-d H:i:s") . '.0',

            ]);
    }

    public function workerUpdate($worker_id, $data)
    {
        $name = $data['name'];
        DB::connection('sigur')->table('personal')
            ->where('STATUS', 'AVAILABLE')
            ->where('ID', $worker_id)
            ->update([
                'NAME' => DB::raw("CAST(CONVERT('$name' USING latin1) AS binary)"),
            ]);
    }

    public function photoUpdate($worker_id, $data)
    {
        $image = file_get_contents($data['image']);
        $ts = substr(preg_replace("/[^0-9]/", '', $image), 0, 10);
        DB::connection('sigur')->table('photo')
            ->where('ID', $worker_id)
            ->update([
                'TS' => $ts,
                'PREVIEW_RASTER' => $image,
                'HIRES_RASTER' => $image,
            ]);
    }

    public function ifPhoto($worker_id)
    {
        return DB::connection('sigur')->table('photo')
            ->where('ID', $worker_id)
            ->exists();
    }

    public function workerDestroy($worker_id)
    {
        DB::connection('sigur')->table('personal')
            ->where('STATUS', 'AVAILABLE')
            ->where('ID', $worker_id)
            ->update([
                'STATUS' => 'FIRED',
                'FIREDTIME' => date("Y-m-d H:i:s") . '.0',
            ]);
    }

    public function objectInfo($object_id)
    {
        return DB::connection('sigur')->table('personal')
            ->selectRaw('*, CAST(CONVERT(NAME USING utf8) AS binary) as NAME')
            ->where('ID', '=', $object_id)->get();
    }

    public function userInfo($location_id)
    {
        return DB::connection('sigur')->table('personal')
            ->selectRaw('*, CAST(CONVERT(NAME USING utf8) AS binary) as NAME')
            ->where('STATUS', 'AVAILABLE')
            ->where('PARENT_ID', '=', $location_id)
            ->where('TYPE', '=', 'EMP')
            ->get();
    }

    public function workerPhoto($data)
    {
        $image = file_get_contents($data['image']);
        $ts = substr(preg_replace("/[^0-9]/", '', $image), 0, 10); // хэш картинки - только первые 10 цифр
        DB::connection('sigur')->table('photo')
            ->insert([
                'ID' => $data['new_id'],
                'TS' => $ts,
                'PREVIEW_RASTER' => $image,
                'HIRES_RASTER' => $image,
            ]);
    }

    public function workerGetPhoto($worker_id)
    {
        return DB::connection('sigur')->table('photo')
            ->where('ID', '=', $worker_id)
            ->select('HIRES_RASTER')
            ->get();
    }

    public function workerAddRule($data)
    {
        DB::connection('sigur')->table('rulebindings')
            ->insert([
                'PERSONAL_ID' => $data['new_id'],
                'RULE_ID' => 1,
            ]);
    }
}
