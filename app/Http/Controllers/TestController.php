<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __invoke()
    {
       
         $user = DB::connection('mysql')->select('select @@version;');
         dd($user);
        //    $user = DB::connection('sigur')->table('personal')->insert('*, CAST(CONVERT(NAME USING utf8) AS binary) as NAME');
        //  dd('Готово');
        //  $user = DB::connection('sigur')->select('select *, CAST(CONVERT(POS USING utf8) AS binary) as POS, CAST(CONVERT(NAME USING utf8) AS binary) as NAME FROM `tc-db-main`.personal WHERE TYPE = \'DEP\' AND STATUS != \'FIRED\' AND PARENT_ID = 0');
        //  foreach($user as $item){
        //     dump($item->NAME);
        //  }
        // dd($user);
    }
}
