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
        if($data['password']==NULL){
            unset($data['password']);
        }
        $email = $data['email_hid'];
        unset($data['email_hid']);
        $data['locations'] = $data['location_id'];
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
