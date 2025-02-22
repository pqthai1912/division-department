<?php

namespace App\Rules;

use App\Utils\MessagesUtil;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ExtensionRule implements ValidationRule
{
    public $extensionName;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($extensionName)
    {
        $this->extensionName = $extensionName;
    }

    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param Closure $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void {
        if (request()->file_csv->getClientOriginalExtension() != $this->extensionName) {
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
        return MessagesUtil::getMessage('ECL033', [$this->extensionName]);
    }
}
