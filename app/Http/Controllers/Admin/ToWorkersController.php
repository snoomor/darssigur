<?php

namespace App\Http\Controllers\Admin;

class ToWorkersController extends BaseController
{
    public function __invoke()
    {
        $cur_location = session('guest_loc_id');
        $locations = $this->service->locations()->get();
        foreach ($locations as $location) {
            $data[$location->ID] = $this->service->locationEdit($location->ID);
        }
        return view('admin.toworkers', compact('cur_location', 'data'));
    }
}
