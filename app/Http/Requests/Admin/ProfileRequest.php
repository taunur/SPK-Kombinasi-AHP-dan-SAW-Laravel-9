<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $userId = Auth::id();

        $rules = [
            'name'     => 'required|max:255',
            'username' => 'required|min:6|max:15|unique:users,username,' . $userId,
            'email'    => 'required|email:dns|unique:users,email,' . $userId,
        ];

        if (Request::instance()->oldPassword || Request::instance()->password || Request::instance()->password_confirmation) {
            $rules = [
                'oldPassword' => 'required',
                'password'    => 'required|confirmed|min:6',
            ];
        }

        return $rules;
    }
}
