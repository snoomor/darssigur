<?php


namespace App\Http\Controllers\Admin;
use App\Models\User;

class UserDestroyController extends BaseController
{
    public function __invoke(User $user) {
        $this->service->destroy($user);
        session()->put('type', 'success');
        session()->flash('flashmessage', 'Профиль удален');
        return redirect()->route('user.create');
    }


}
