<?php
if(!function_exists('bcrypt')) {
    /**
     * Hashes a password using the bcrypt algorithm.
     *
     * @param string $password The password to hash.
     * @return string The hashed password.
     */
    function bcrypt($password)
    {
        // $options = [
        //     'cost' => 60, // You can adjust the cost factor as needed
        // ];
        return password_hash($password, PASSWORD_BCRYPT);
    }
}

if(!function_exists('verify_bcrypt')) {
    /**
     * Verifies a password against a hashed password.
     *
     * @param string $password The plain text password to verify.
     * @param string $hash The hashed password to verify against.
     * @return bool True if the password matches, false otherwise.
     */
    function verify_bcrypt(string $password,string $hash):bool
    {
        return password_verify($password, $hash);
    }
}