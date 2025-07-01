<?php
if (!function_exists('request')) {
    function request( $request = null) {

        return $_REQUEST[$request] ?$_REQUEST[$request] : null;
    }
}