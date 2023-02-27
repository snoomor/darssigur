<?php

namespace App\Http\Controllers\Admin;

class LocationsGrAddController extends BaseController
{
    public function __invoke($location_id)
    {   
        $data = $this->service->locationInfo($location_id);
        $parent_loc = $data[0];
        return view('admin.loc_gr_create', compact('parent_loc'));
    }

}
