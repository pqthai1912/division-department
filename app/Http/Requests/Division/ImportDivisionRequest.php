<?php

namespace App\Http\Requests\Division;

use App\Rules\ExtensionRule;
use Illuminate\Foundation\Http\FormRequest;

class ImportDivisionRequest extends FormRequest
{
    /**
     * Determine if the division is authorized to make this request.
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
            'file_csv' => [
                new ExtensionRule('csv'),
                'max:1024'
            ],
        ];
    }

    public function messages()
    {
        return [
            'file_csv.max' => 'The file size limit of 1MB has been exceeded.',
        ];
    }
}
