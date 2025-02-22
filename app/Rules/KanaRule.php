<?php

namespace App\Rules;

use App\Utils\JapaneseUtil;
use App\Utils\MessagesUtil;
use Illuminate\Contracts\Validation\Rule;

class KanaRule implements Rule
{
    public $fieldName;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($fieldName)
    {
        //
        $this->fieldName = $fieldName;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        return JapaneseUtil::isKatakana($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return MessagesUtil::getMessage('E023', [$this->fieldName]);
    }
}
