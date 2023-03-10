<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class Service
{
    public function userLocUpdate($user, $data)
    {
        $user->update($data);
    }

    public function locations()
    {
        $locations = DB::connection('sigur')->table('personal')
            ->selectRaw('*, CAST(CONVERT(NAME USING utf8) AS binary) as NAME')
            ->where('TYPE', '=', 'DEP')
            ->where('PARENT_ID', '=', '0')
            ->where('STATUS', '!=', 'FIRED');
        return $locations;
    }

    public function devices()
    {
        return DB::connection('sigur')->table('devices')
            ->selectRaw('*, CAST(CONVERT(NAME USING utf8) AS binary) as NAME')
            ->get();
    }

    public function userStore($data)
    {
        $data['password'] = Hash::make($data['password']);
        $request = User::firstOrCreate([
            'email' => $data['email'],
        ], $data);

        return ($request->wasRecentlyCreated);
    }

    public function update($user, $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $user->update($data);
    }

    public function destroy($user)
    {
        $user->delete();
    }

    public function locationsStore($data)
    {
        $name = $data['name_loc'];
        $parent_loc = $data['parent_loc'];
        $createdtime = date("Y-m-d H:i:s") . '.0';
        DB::connection('sigur')->table('personal')->insert([
            'PARENT_ID' => $parent_loc,
            'TYPE' => 'DEP',
            'STATUS' => 'AVAILABLE',
            'CREATEDTIME' => $createdtime,
            'NAME' => DB::raw("CAST(CONVERT('$name' USING latin1) AS binary)"),
        ]);
    }

    public function locationEdit($location_id)
    {
        $data['location'] = DB::connection('sigur')->table('personal')
            ->selectRaw('*, CAST(CONVERT(NAME USING utf8) AS binary) as NAME')
            ->where('ID', '=', $location_id)
            ->get();

        $data['groupings'] = DB::connection('sigur')->table('personal')
            ->selectRaw('*, CAST(CONVERT(NAME USING utf8) AS binary) as NAME')
            ->where('TYPE', '=', 'DEP')
            ->where('PARENT_ID', '=', $location_id)
            ->where('STATUS', '!=', 'FIRED')
            ->get();
        return $data;
    }

    public function locationInfo($location_id)
    {
        return DB::connection('sigur')->table('personal')
            ->selectRaw('*, CAST(CONVERT(NAME USING utf8) AS binary) as NAME')
            ->where('ID', '=', $location_id)
            ->get();
    }

    public function locationUpdate($data, $location_id)
    {
        $name = $data['name_loc'];
        DB::connection('sigur')->table('personal')
        ->where('ID', '=', $location_id)
        ->update([
            'NAME' => DB::raw("CAST(CONVERT('$name' USING latin1) AS binary)"),
        ]);
        
    }

    public function locationDestroy($location_id)
    {
        DB::connection('sigur')->table('personal')
            ->where('PARENT_ID', '=', $location_id)
            ->where('STATUS', 'AVAILABLE')
            ->orWhere('ID', $location_id)
            ->update([
                'STATUS' => 'FIRED',
                'FIREDTIME' => date("Y-m-d H:i:s") . '.0',
            ]);
    }
}
