<?php

namespace App\Http\Requests\Admin;

use App\Rules\CyrillicAndSpace;
use App\Rules\Location;
use App\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', new CyrillicAndSpace(),],
            'email' => 'required|string|email',
            'location_id' => ['required', new Location(),],
            'groupings' => '',
            'role' => 'required|string',
            'devices' => '',
            'password' => ['required','max:20','min:8', new Password(),],
            'send'  => '',
        ];
    }
}
