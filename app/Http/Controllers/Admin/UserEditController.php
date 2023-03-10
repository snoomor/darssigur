<?php


namespace App\Http\Controllers\Admin;

use App\Models\User;

class UserEditController extends BaseController
{
    public function __invoke(User $user) {
        $devices = $this->service->devices();
        $locations = $this->service->locations()->get();
        foreach ($locations as $location) {
            $data[$location->ID] = $this->service->locationEdit($location->ID);
        }
        $cur_loc =  $this->service->locationInfo(session('guest_loc_id'));
        $cur_dev = explode(';', $user->devices);
        unset($user->password);
        return view('admin.user_edit', compact('user','locations', 'data', 'cur_loc', 'devices', 'cur_dev'));
    }
}