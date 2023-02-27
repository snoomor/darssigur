<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class LocationsGrEditController extends BaseController
{
    public function __invoke($location_id)
    {   
        $data = $this->service->locationInfo($location_id);
        $location = $data[0];
        return view('admin.loc_gr_edit', compact('location'));
    }
}
