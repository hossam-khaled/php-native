<?php

if(!function_exists("session")){
    function session(string $key, mixed $vlaue = null) {
        if(!is_null($vlaue)) {
            $_SESSION[$key] = aes_encrypt($vlaue);
        }

        return isset($_SESSION[$key]) ? aes_decrypt($_SESSION[$key]) : '';
    }
}

if(!function_exists("session_has")){
    function session_has(string $key) {
        return isset($_SESSION[$key]);
    }
}

if(!function_exists("session_flash")){
    function session_flash(string $key, mixed $vlaue = null) {
        if(!is_null($vlaue)) {
            $_SESSION[$key] = $vlaue;
        }

        $session = isset($_SESSION[$key]) ? $_SESSION[$key] : '';
        session_forget($key); // remove the session after getting it
        return $session;
    }
}

if(!function_exists("session_forget")){
    function session_forget(string $key) {
       if (isset($_SESSION[$key]) ){
           unset($_SESSION[$key]);
        //    echo 'Done ..!';
       }else{
            echo "This ". $key .' not set';
       }
    }
}

if(!function_exists("session_delete_all")){
    function session_delete_all() {
        session_destroy();
    }
}