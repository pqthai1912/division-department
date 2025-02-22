<?php

namespace App\Http\Requests\Auth;

use App\Rules\MaxLengthRule;
use App\Utils\MessagesUtil;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class LoginRequest extends FormRequest
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
        return [
            'email' => ['required', 'email', new MaxLengthRule(255, 'Email'),
            Rule::exists('user', 'email')->where(function ($query) {
                return $query->whereNull('deleted_date'); // only accept account wasn't deleted
            })],
            'password' => ['required', new MaxLengthRule(20, 'Password')],
            //
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => MessagesUtil::getMessage('ECL001', ['Email']),
            'email.email' => MessagesUtil::getMessage('ECL005'),
            'email.exists' => MessagesUtil::getMessage('ECL016'),
            'password.required' =>  MessagesUtil::getMessage('ECL001', ['Password']),
        ];
    }
}
