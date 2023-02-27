<?php

namespace App\Http\Controllers\Admin;

class LocationsEditController extends BaseController
{
    public function __invoke($location_id)
    {
        $data = $this->service->locationEdit($location_id);
        $location = $data['location'];
        $groupings = $data['groupings'];
        return view('admin.loc_edit', compact('location','groupings'));
    }
}
