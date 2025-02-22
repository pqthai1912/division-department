<?php

namespace App\Http\Requests\User;

use App\Rules\MaxLengthRule;
use App\Rules\MinLengthRule;
use App\Utils\MessagesUtil;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => ['required', new MaxLengthRule(50, 'User Name')],
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9~`!@#$%^&*()-_=+<>?,.\/\:;"\'{}]+$/',
             new MaxLengthRule(255, 'Email'), 'unique:user,email'],
            'division_id' => ['required'],
            'entered_date' => ['required', 'date_format:Y/m/d'],
            'position_id' => ['required'],
            'password' => ['required', 'min:8',
             'max:20', 'regex:/^[a-z0-9]+$/', 'same:password_confirmation'],
            'password_confirmation' => ['required', new MaxLengthRule(20, 'Password Confirmation')],
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
            'name.required' => MessagesUtil::getMessage('ECL001', ['User Name']),
            'email.required' => MessagesUtil::getMessage('ECL001', ['Email']),
            'email.email' => MessagesUtil::getMessage('ECL005'),
            'email.regex' => MessagesUtil::getMessage('ECL004', ['Email']),
            'email.unique' => MessagesUtil::getMessage('ECL019'),
            'division_id.required' => MessagesUtil::getMessage('ECL001', ['Division']),
            'entered_date.required' => MessagesUtil::getMessage('ECL001', ['Entered Date']),
            'entered_date.date_format' => MessagesUtil::getMessage('ECL008', ['Entered Date']),
            'position_id.required' => MessagesUtil::getMessage('ECL001', ['Position']),
            'password.required' =>  MessagesUtil::getMessage('ECL001', ['Password']),
            'password.min' =>  MessagesUtil::getMessage('ECL023'),
            'password.max' =>  MessagesUtil::getMessage('ECL023'),
            'password.regex' =>  MessagesUtil::getMessage('ECL023'),
            'password.same' =>  MessagesUtil::getMessage('ECL030'),
            'password_confirmation.required' =>  MessagesUtil::getMessage('ECL001', ['Password Confirmation']),
        ];
    }
}
