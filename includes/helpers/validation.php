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
    function validation( $attribute,string $rules, $trans=null): array
    {
        global $validations;
        $errors = [];
        $value = request($attribute);
        $final_attr = !is_null($trans) ? $trans : $attribute;
        foreach (explode('|', $rules) as $field => $rule) {
            if ($rule == 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errors[] = str_replace(':attribute', $final_attr, lang('validation.email'));
            }elseif( $rule == 'required' && ( empty( $value) || is_null($value ) ) ) {
                $errors[] = str_replace(':attribute', $final_attr, lang('validation.required') );
            }

        }

        if( !empty( $errors ) && is_array($errors) && count( $errors ) > 0){

            $validations[$attribute] = $errors;
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
    function any_errors($offset=null) {
        return !is_null($GLOBALS['validations']) && isset( $GLOBALS['validations'][$offset]) ? $GLOBALS['validations'][$offset] : $GLOBALS['validations']; 
    }
}