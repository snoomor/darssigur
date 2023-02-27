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
        $data['locations'] = $data['location_id'];
        if (isset($data['groupings'])) {
            $data['locations'] = $data['groupings'];
            unset($data['groupings']);
        }
        if (isset($data['send'])) {
            $send = true;
            unset($data['send']);
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
