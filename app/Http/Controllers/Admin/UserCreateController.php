<?php


namespace App\Http\Controllers\Admin;

use App\Models\User;

class UserCreateController extends BaseController
{
    public function __invoke()
    {
        $users = User::paginate(10);
        $locations = $this->service->locations()->get();
        foreach ($locations as $location) {
            $data[$location->ID] = $this->service->locationEdit($location->ID);
        }
        return view('admin.user_create', compact('data', 'users'));
    }
}
