<?php

namespace App\Rules;

use App\Utils\MessagesUtil;
use Illuminate\Contracts\Validation\Rule;

class MaxLengthRule implements Rule
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
        //
        $this->currNumber = 0;
        $this->maxNumber = $maxNumber;
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
        return $this->currNumber <= $this->maxNumber;
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
