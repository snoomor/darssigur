<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UserLocUpdateRequest;
use App\Models\User;

class ToWorkersUpdateController extends BaseController
{
    public function __invoke(UserLocUpdateRequest $request,User $user)
    {
        $data = $request->validated();
        $data['locations'] = $data['location_id'];
        if (isset($data['groupings'])) {
            $data['locations'] = $data['groupings'];
        }
        unset($data['location_id']);
        unset($data['groupings']);
        $this->service->userLocUpdate($user, $data);
        session()->put('guest_loc_id', $user->location_id);
        return redirect()->route('worker.create');
    }
}
