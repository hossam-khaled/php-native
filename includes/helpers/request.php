<?php
/**
 * Retrieves a value from the $_REQUEST superglobal array.
 *
 * This function checks if a specific request parameter exists in the $_REQUEST array
 * and returns its value if present. If the parameter does not exist, it returns null.
 *
 * @param string|null $request The name of the request parameter to retrieve.
 * @return mixed|null The value of the request parameter if set, or null if not found.
 */
if (!function_exists('request')) {
    function request( $request = null) {

        return $_REQUEST[$request] ?$_REQUEST[$request] : null;
    }
}