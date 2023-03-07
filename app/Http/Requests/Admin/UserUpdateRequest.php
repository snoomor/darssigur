<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Password;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required|string',
            'email_hid' => '',
            'location_id' => 'required|integer',
            'groupings' => '',
            'role' => 'required|string',
            'password' => ['nullable', 'max:20','min:8', new Password(),],
            'send' => '',
        ];
    }
}
