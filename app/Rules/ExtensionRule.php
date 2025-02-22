<?php

namespace App\Rules;

use App\Utils\MessagesUtil;
use Illuminate\Contracts\Validation\Rule;

class ExtensionRule implements Rule
{

    public $extensionName;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($extensionName)
    {
        //
        $this->extensionName = $extensionName;
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
        return request()->file_csv->getClientOriginalExtension() == $this->extensionName;
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
