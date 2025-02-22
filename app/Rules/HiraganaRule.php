<?php

namespace App\Rules;

use App\Utils\JapaneseUtil;
use App\Utils\MessagesUtil;
use Illuminate\Contracts\Validation\Rule;

class HiraganaRule implements Rule
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
        return JapaneseUtil::isHiragana($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return MessagesUtil::getMessage('E022', [$this->fieldName]);
    }
}
