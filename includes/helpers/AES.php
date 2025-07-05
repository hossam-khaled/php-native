<?php

if (!function_exists('aes_encrypt')) {
    function aes_encrypt($value) :string
    {
        $cipher = config("session.encrypt_cipher");
        $key = config("session.encrypt_key"); // Must be 16 bytes for AES-128
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher));
        $encrypted = openssl_encrypt($value, $cipher, $key, OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $encrypted, $key, true);
        // var_dump(base64_encode($iv . $hmac . $encrypted));
        return base64_encode($iv . $hmac . $encrypted);
    }
}

if (!function_exists('aes_decrypt')) {
    function aes_decrypt($value) :string
    {
        $cipher = config("session.encrypt_cipher");
        $key = config("session.encrypt_key"); // Must be 16 bytes for AES-128
        $decode64 = base64_decode($value);
        $iv_length = openssl_cipher_iv_length($cipher);
        $iv = substr($decode64, 0, $iv_length);
        $hmac = substr($decode64, $iv_length, 32);
        $ciphertext_raw = substr($decode64, $iv_length + 32);
        $original_text = openssl_decrypt($ciphertext_raw, $cipher, $key, OPENSSL_RAW_DATA, $iv);
        $calculated_hmac = hash_hmac('sha256', $ciphertext_raw, $key, true);
        if (!hash_equals($hmac, $calculated_hmac)) {
            throw new Exception('Decryption failed: HMAC does not match.');
        }else{
            // var_dump($original_text);

            return $original_text;
        }
    }
}