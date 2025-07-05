<?php

if(!function_exists("session")){
    /**
     * Stores or retrieves a value in the session with AES encryption.
     *
     * If a value is provided, it encrypts the value and stores it in the session under the specified key.
     * If no value is provided, it retrieves and decrypts the value from the session for the given key.
     *
     * @param string $key   The session key to store or retrieve the value.
     * @param mixed  $vlaue (Optional) The value to store in the session. If null, the function retrieves the value.
     * @return mixed        The decrypted value from the session if it exists, otherwise an empty string.
     */
    function session(string $key, mixed $vlaue = null) {
        if(!is_null($vlaue)) {
            $_SESSION[$key] = aes_encrypt($vlaue);
        }

        return isset($_SESSION[$key]) ? aes_decrypt($_SESSION[$key]) : '';
    }
}

if(!function_exists("session_has")){
    /**
     * Check if a specific key exists in the current session.
     *
     * @param string $key The session key to check for existence.
     * @return bool Returns true if the session key exists, false otherwise.
     */
    function session_has(string $key) {
        return isset($_SESSION[$key]);
    }
}

/**
 * Sets or retrieves a flash session value by key.
 *
 * If a value is provided, it sets the session value for the given key.
 * When called without a value, it retrieves the session value for the key,
 * removes it from the session, and returns it.
 *
 * @param string $key   The session key to set or retrieve.
 * @param mixed  $vlaue (Optional) The value to set for the session key.
 *                      If null, the function will retrieve and remove the value.
 * @return mixed        The session value associated with the key, or an empty string if not set.
 */
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

/**
 * Removes a specific key from the session if it exists.
 *
 * @param string $key The session key to remove.
 * 
 * If the session key exists, it will be unset from the $_SESSION superglobal.
 * If the session key does not exist, a message will be echoed indicating that the key is not set.
 */
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

/**
 * Destroys all data registered to a session.
 *
 * This function calls session_destroy() to remove all session data.
 * It should be called when you want to completely clear the session,
 * such as during logout or when resetting user data.
 *
 * @return void
 */
if(!function_exists("session_delete_all")){
    function session_delete_all() {
        session_destroy();
    }
}