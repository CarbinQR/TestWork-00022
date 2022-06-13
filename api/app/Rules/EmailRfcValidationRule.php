<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

final class EmailRfcValidationRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $email_matches = array();

        $from_regex = '[a-zA-Z0-9_,\s\-\ \.\+\^!#\$%&*+\/\=\?\`\|\{\}~\']+';
        $user_regex = '[a-zA-Z0-9_\-\.\+\^!#\$%&*+\/\=\?\`\|\{\}~\']+';
        $domain_regex = '(?:(?:[a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9])\.?)+';
        $ipv4_regex = '[0-9]{1,3}(\.[0-9]{1,3}){3}';
        $ipv6_regex = '[0-9a-fA-F]{1,4}(\:[0-9a-fA-F]{1,4}){7}';

        preg_match("/^$from_regex\s\<(($user_regex)@($domain_regex|(\[($ipv4_regex|$ipv6_regex)\])))\>$/", $value, $matches_2822);
        preg_match("/^($user_regex)@($domain_regex|(\[($ipv4_regex|$ipv6_regex)\]))$/", $value, $matches_normal);

        // Check for valid email as per RFC 2822 spec.
        if (empty($matches_normal) && !empty($matches_2822) && !empty($matches_2822[3])) {
            $email_matches['from_name'] = $matches_2822[0];
            $email_matches['full_email'] = $matches_2822[1];
            $email_matches['email_name'] = $matches_2822[2];
            $email_matches['domain'] = $matches_2822[3];
        }

        // Check for valid email as per RFC 822 spec.
        if (empty($matches_2822) && !empty($matches_normal) && !empty($matches_normal[2])) {
            $email_matches['from_name'] = '';
            $email_matches['full_email'] = $matches_normal[0];
            $email_matches['email_name'] = $matches_normal[1];
            $email_matches['domain'] = $matches_normal[2];
        }

        return !blank($email_matches);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid email address.';
    }
}
