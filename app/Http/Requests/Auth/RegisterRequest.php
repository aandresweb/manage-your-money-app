<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends FormRequest
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
            //
        ];
    }

    public function prepareForValidation()
    {

        return $this->merge([
            'name' => ucfirst($this->name),
            'password' => Hash::make($this->password),
            'remember_token' => md5($this->name . $this->email)
        ]);
    }
}
