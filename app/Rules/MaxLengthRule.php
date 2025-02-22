<?php

namespace App\Rules;

use App\Utils\MessagesUtil;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaxLengthRule implements ValidationRule
{
    public $currNumber;
    public $maxNumber;

    public $attribute;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($maxNumber, $attribute)
    {
        $this->currNumber = 0;
        $this->maxNumber = $maxNumber;
        $this->attribute = $attribute;
    }

    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param Closure $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void {
        if (isset($value)) {
            $this->currNumber = strlen($value);
            if ($this->currNumber > $this->maxNumber) {
                $fail($this->message());
            }
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return MessagesUtil::getMessage('ECL002', [$this->attribute, $this->maxNumber, $this->currNumber]);
    }
}
