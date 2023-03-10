<?php


namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Models\User;
use App\Mail\UpdatePassMailClass;
use Illuminate\Support\Facades\Mail;

class UserUpdateController extends BaseController
{
    public function __invoke(UserUpdateRequest $request, User $user)
    {  
        $data = $request->validated();
        $devices = '';
        if($data['password']==NULL){
            unset($data['password']);
        }
        if (isset($data['groupings'])) {
            $data['locations'] = $data['groupings'];
            unset($data['groupings']);
        }
        if (isset($data['devices'])){
            foreach ($data['devices'] as $device) {
                $devices .= $device.';';
            }
            $devices = substr($devices,0,-1);
            $data['devices'] = $devices;
        }
        $email = $data['email_hid'];
        $data['locations'] = $data['location_id'];
        unset($data['email_hid']);
        unset($data['location_id']);

        $this->service->update($user, $data);

        if (isset($data['password'])){
            Mail::to($email)->send(new UpdatePassMailClass($data, $email));
        }
        
        session()->put('type', 'success');
        session()->flash('flashmessage', 'Изменения сохранены');

        return redirect()->route('user.create');
    }
}
