<?php

namespace App\Http\Controllers\Admin;

class LocationsController extends BaseController
{
    public function __invoke()
    {
        $locations = $this->service->locations()->paginate(10);
        return view('admin.loc_create', compact('locations'));
    }
}
