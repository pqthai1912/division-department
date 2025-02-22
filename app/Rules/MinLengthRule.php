<?php

namespace App\Rules;

use App\Utils\MessagesUtil;
use Illuminate\Contracts\Validation\Rule;

class MinLengthRule implements Rule
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
        //
        $this->currNumber = 0;
        $this->minNumber = $minNumber;
        $this->attribute = $attribute;
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
        $this->currNumber = strlen($value);
        return $this->currNumber >= $this->minNumber;
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
