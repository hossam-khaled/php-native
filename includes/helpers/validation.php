<?php
$validations = [];

if (!function_exists('validation')) {
    /**
     * validation the given data against the specified rules.
     *
     * @param array $data The data to validate.
     * @param array $rules The validation rules.
     * @return array An array of validation errors, if any.
     */
    function validation( $attribute, $rule): array
    {
        global $validations;
        $errors = [];
        $value = request($attribute);
        if ($rule == 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $validations[$attribute] = str_replace(':attribute', $value, lang('validation.email'));
        }
        // foreach ($rules as $field => $rule) {
        //     if (isset($data[$field])) {
        //         // Example rule: required
        //         if ($rule === 'required' && empty($data[$field])) {
        //             $errors[$field] = "$field is required.";
        //         }
        //         // Add more rules as needed
        //     } else {
        //         $errors[$field] = "$field is missing.";
        //     }
        // }

        return $errors;
    }
}


if (!function_exists('any_errors')) {
    function any_errors($offset) {
        return isset( $GLOBALS['validations'][$offset]) ? $GLOBALS['validations'][$offset] : null; 
    }
}