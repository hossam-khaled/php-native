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
    function validation(array $attributes, array $trans, $http_header = 'redirect', $back = null)
    {
        $validations = [];
        $values = [];
        foreach ($attributes as $attribute => $rules) {
            
            $value = request($attribute);
            $values[$attribute] = $value;
            // if( $attribute == 'icon'){
            //     var_dump(getimagesize($value['tmp_name'] ));
            //     die;
            // }
            $errors = [];
            $final_attr = isset($trans[$attribute]) ? $trans[$attribute] : $attribute;
            foreach (explode('|', $rules) as $field => $rule) {
                if ($rule == 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = str_replace(':attribute', $final_attr, lang('validation.email'));
                } elseif ($rule == 'required' && (empty($value) || is_null($value) || ( isset($value['tmp_name']) && empty( $value['tmp_name'] ) ) )) {
                    $errors[] = str_replace(':attribute', $final_attr, lang('validation.required'));
                } elseif ($rule == 'integer' && !filter_var($value, FILTER_VALIDATE_INT)) {
                    $errors[] = str_replace(':attribute', $final_attr, lang('validation.integer'));
                } elseif ($rule == 'string' && !is_string($value)) {
                    $errors[] = str_replace(':attribute', $final_attr, lang('validation.string'));
                } elseif ($rule == 'numeric' && !is_numeric($value)) {
                    $errors[] = str_replace(':attribute', $final_attr, lang('validation.numeric'));
                } elseif ($rule == 'image' && isset($value['tmp_name']) && ( !empty($value['tmp_name'] ) && getimagesize($value['tmp_name'] ) === false )) {
                    $errors[] = str_replace(':attribute', $final_attr, lang('validation.image'));
                }
            }
            if (!empty($errors) && is_array($errors) && count($errors) > 0) {
                $validations[$attribute] = $errors;
            }
        }

        if (count($validations) > 0) {
            if ($http_header == 'redirect') {
                session('errors', json_encode($validations));
                session('old', json_encode($values));
                if (!is_null($back)) {
                    redirect($back);
                } else {
                    back();
                    // redirect(ADMIN . '/login');
                }
            } elseif ($http_header == 'api') {
                return json_encode($validations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }
        } else {
            return $values;
        }
    }
}


if (!function_exists('any_errors')) {
    function any_errors($offset = null)
    {
        $array = json_decode(session('errors'), true);
        if (isset($array[$offset])) {
            $text = $array[$offset];
            // unset($array[$offset]);
            // session_flash('errors');
            // if(!empty( $array )){
            //     session('errors',json_encode($array));
            // }

            return is_array($text) ? $text : [];
        } elseif (!empty($array) && count($array) > 0) {
            return $array;
        } else {
            return [];
        }
        // return isset( $array[$offset] ) ? $array[$offset] : $array;
        // return !is_null($GLOBALS['validations']) && isset( $GLOBALS['validations'][$offset]) ? $GLOBALS['validations'][$offset] : $GLOBALS['validations']; 
    }
}

if (!function_exists('all_errors')) {
    function all_errors()
    {
        $all_errors = [];
        foreach (any_errors() as $errors):
            foreach ($errors as $error):
                $all_errors[] = $error;
            endforeach;
        endforeach;
        return $all_errors;
    }
}

if (!function_exists('get_error')) {
    function get_error($offset)
    {
        $error = '<ul>';
        foreach (any_errors($offset) as $error_string):
            if (is_string($error_string)) {
                $error .= " <li> $error_string </li>";
            }
        endforeach;
        $error .= '</ul>';
        return  !empty(any_errors($offset)) ? $error : null;
    }
}
if (!function_exists('end_errors')) {
    function end_errors()
    {
        session_flash('errors');
    }
}
if (!function_exists('old')) {
    function old($request = null)
    {
        $old_values = json_decode(session('old'), true);
        // var_dump($old_values[$request]);
        if (is_array($old_values) && in_array($request, array_keys($old_values))) {
            return isset($old_values[$request]) ? $old_values[$request] : null;
        } elseif (is_null($request)) {
            return $old_values;
        }
    }
}