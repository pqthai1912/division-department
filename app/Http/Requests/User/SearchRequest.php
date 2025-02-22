<?php

namespace App\Http\Requests\User;

use App\Rules\MaxLengthRule;
use App\Utils\MessagesUtil;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchRequest extends FormRequest
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
        // check button is clicked is search or not
        if (request()->input('action') == 'search') {
            return [
                'name' => ['nullable', new MaxLengthRule(100, 'User Name')],
                'entered_date_from' => ['nullable', 'date_format:Y/m/d'],
                'entered_date_to' => ['nullable', 'date_format:Y/m/d', 'after_or_equal:entered_date_from'],
            ];
        }
        return [
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
            'entered_date_from.date_format' =>  MessagesUtil::getMessage('ECL008', ['Entered Date From']),
            'entered_date_to.date_format' =>  MessagesUtil::getMessage('ECL008', ['Entered Date To']),
            'entered_date_to.after_or_equal' =>  MessagesUtil::getMessage('ECL044'),

        ];
    }
}
