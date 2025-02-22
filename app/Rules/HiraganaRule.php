<?php

namespace App\Rules;

use App\Utils\JapaneseUtil;
use App\Utils\MessagesUtil;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class HiraganaRule implements ValidationRule
{
    public $fieldName;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($fieldName)
    {
        $this->fieldName = $fieldName;
    }

    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param Closure $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void {
        if (isset($value) && !JapaneseUtil::isHiragana($value)) {
            $fail($this->message());
        }
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
