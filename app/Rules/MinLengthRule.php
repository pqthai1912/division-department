<?php

namespace App\Rules;

use App\Utils\MessagesUtil;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MinLengthRule implements ValidationRule
{
    public $currNumber;
    public $minNumber;
    public $attribute;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($minNumber, $attribute)
    {
        $this->currNumber = 0;
        $this->minNumber = $minNumber;
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
            if ($this->currNumber < $this->minNumber) {
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
        return MessagesUtil::getMessage('ECL003', [$this->attribute, $this->minNumber, $this->currNumber]);
    }
}
