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
    function validation( array $attributes, array $trans )
    {
        global $validations;
        foreach( $attributes as $attribute => $rules) {

            $value = request($attribute);
            $errors = [];
            $final_attr = isset($trans[$attribute]) ? $trans[$attribute] : $attribute;
            foreach (explode('|', $rules) as $field => $rule) {
                if ($rule == 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = str_replace(':attribute', $final_attr, lang('validation.email'));
                }elseif( $rule == 'required' && ( empty( $value) || is_null($value ) ) ) {
                    $errors[] = str_replace(':attribute', $final_attr, lang('validation.required') );
                }elseif( $rule == 'integer' && !is_integer($value ) ) {
                    $errors[] = str_replace(':attribute', $final_attr, lang('validation.integer') );
                }elseif( $rule == 'string' && !is_string($value ) ) {
                    $errors[] = str_replace(':attribute', $final_attr, lang('validation.string') );
                }
                
            }
            if( !empty( $errors ) && is_array($errors) && count( $errors ) > 0){
                $validations[$attribute] = $errors;
            }
        }
            
        session('errors',json_encode($validations));

    }
}


if (!function_exists('any_errors')) {
    function any_errors($offset=null) {
        $array = json_decode(session('errors'),true);
        if(isset($array[$offset] )) {
            $text = $array[$offset];
            // unset($array[$offset]);
            // session_flash('errors');
            // if(!empty( $array )){
            //     session('errors',json_encode($array));
            // }

            return is_array($text ) ?$text:[];
        }elseif( !empty( $array ) && count($array ) > 0 ){
            return $array;
        }else{
            return [];
        }
        // return isset( $array[$offset] ) ? $array[$offset] : $array;
        // return !is_null($GLOBALS['validations']) && isset( $GLOBALS['validations'][$offset]) ? $GLOBALS['validations'][$offset] : $GLOBALS['validations']; 
    }
}

if (!function_exists( 'all_errors')) {
    function all_errors() {
        $all_errors = [];
        foreach( any_errors() as $errors):
            foreach( $errors as $error):
                 $all_errors[] = $error ;
            endforeach;
        endforeach;
        return $all_errors;
    }
}

if (!function_exists( 'get_error')) {
    function get_error( $offset ) {
        $error = '<ul>';
        foreach( any_errors( $offset ) as $error_string):
            if( is_string( $error_string ) ){
                $error .= " <li> $error_string </li>";
            }
        endforeach;
        $error .= '</ul>';
        return  !empty(any_errors( $offset ) ) ? $error : null;
    }
}