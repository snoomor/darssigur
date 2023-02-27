<?php


namespace App\Http\Controllers\Admin;

use App\Models\User;

class UserEditController extends BaseController
{
    public function __invoke(User $user) {
        $locations = $this->service->locations()->get();
        unset($user->password);
        return view('admin.user_edit', compact('user','locations'));
    }
}