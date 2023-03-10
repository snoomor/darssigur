<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UserStoreRequest;
use App\Mail\LoginMailClass;
use Illuminate\Support\Facades\Mail;

class UserStoreController extends BaseController
{
    public function __invoke(UserStoreRequest $request)
    {
        $data = $request->validated();
        $send = false;
        $devices = '';
        $data['locations'] = $data['location_id'];
        if (isset($data['groupings'])) {
            $data['locations'] = $data['groupings'];
            unset($data['groupings']);
        }
        if (isset($data['send'])) {
            $send = true;
            unset($data['send']);
        }
        if (isset($data['devices'])){
            foreach ($data['devices'] as $device) {
                $devices .= $device.';';
            }
            $devices = substr($devices,0,-1);
            $data['devices'] = $devices;
        }

        unset($data['location_id']);
        if ($this->service->userStore($data)) {
            if ($send) {
                Mail::to($data['email'])->send(new LoginMailClass($data));
            }
            $type = 'success';
            $message = 'Профиль успешно создан!';
        } else {
            $type = 'warning';
            $message = 'Пользователь с такой почтой уже существует!';
        }

        session()->put('type', $type);
        session()->flash('flashmessage', $message);
        return redirect()->route('user.create');
    }
}
