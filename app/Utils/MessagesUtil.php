<?php

namespace App\Utils;

class MessagesUtil
{

    /**
     * @param string $message
     * @param string $type
     * @return string
     */
    public static function getMessage($code, $options = [])
    {
        $delimiters = ['{', '}'];
        // check space before up
        $msgArrays = [
            'ECL001' => '{0} is a required item.',
            'ECL002' => 'Please enter {0} with less than "{1}" characters. (currently {2} characters)',
            'ECL003' => 'Please enter more than "{1}" characters for {0}. (currently {2} characters)',
            'ECL004' => 'Please enter {0} in single-byte alphanumeric characters.',
            'ECL005' => 'Please enter your e-mail address correctly.',
            'ECL006' => 'Please enter {0} in full-width characters.',
            'ECL007' => 'Please enter {0} in double-byte Kana.',
            'ECL008' => 'Enter the correct date for {0}.',
            'ECL009' => 'Please enter the correct postal code for {0}.',
            'ECL010' => 'Enter the correct number for {0}.',
            'ECL011' => 'Please enter the correct phone number for {0}.',
            'ECL012' => 'There is no result.',
            'ECL013' => '{0}. Is it OK?',
            'ECL014' => 'Please create a new account again.',
            'ECL015' => 'Please reset your password again.',
            'ECL016' => 'Member ID or email address is incorrect.',
            'ECL017' => "One of the information you entered is incorrect.\nPlease check and try again.",
            'ECL018' => 'The confirmation email address is incorrect.',
            'ECL019' => 'Your email address is already registered.',
            'ECL020' => 'You entered the wrong characters.',
            'ECL021' => 'Consent to the privacy policy is required.',
            'ECL022' => 'You must agree to the terms of use.',
            'ECL023' => 'Enter the password in 8 to 20 characters using half-width alphanumeric characters.',
            'ECL024' => 'The password cannot be the same value as the member ID.',
            'ECL025' => 'The password cannot contain only single-byte numbers or only single-byte alphabetic characters.',
            'ECL026' => 'Your current password is incorrect.',
            'ECL027' => 'Member ID is already registered.',
            'ECL028' => 'You are already registered as a member.',
            'ECL029' => 'An unexpected operation was requested. This error occurs when you refresh the browser or repeatedly press the button.',
            'ECL030' => 'The confirmation password is incorrect.',
            'ECL033' => 'Incorrect file format. Please select {0}.',
            'ECL044' => 'Please specify the contract end date as the scheduled cancellation date.',
            'ECL046' => 'The number of CSV output is {0}.',
            'ECL064' => 'You don\'t have permission to access it.',
            'ECL086' => 'The certificate number has already been registered.',
            'ECL092' => 'Successfully imported.',
            'ECL093' => 'Failed to register/update/delete.',
            'ECL094' => '{0} does not exist.',
            'ECL095' => 'The contents of the import file are incorrect.',
        ];

        // if message has parameter
        if ($options) {
            foreach ($options as $k => $v) {
                $options[$delimiters[0] . $k . $delimiters[1]] = $v;
                unset($options[$k]);
            }
            return strtr($msgArrays[$code], $options) ?? null;
        }
        return $msgArrays[$code] ?? null;
    }
}
