<?php

/**
 * Encrypts a given value using AES encryption.
 *
 * This function uses the cipher and key specified in the configuration
 * (typically from "session.encrypt_cipher" and "session.encrypt_key").
 * It generates a random initialization vector (IV) for each encryption,
 * encrypts the value using OpenSSL, and then computes an HMAC for integrity.
 * The IV, HMAC, and encrypted data are concatenated and base64-encoded
 * for safe storage or transmission.
 *
 * @param string $value The plaintext value to encrypt.
 * @return string The base64-encoded string containing the IV, HMAC, and encrypted data.
 */
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
/**
 * Decrypts a value encrypted with AES and verifies its integrity using HMAC.
 *
 * This function expects the input value to be a base64-encoded string containing:
 * - Initialization Vector (IV)
 * - HMAC (SHA-256)
 * - Encrypted ciphertext
 *
 * The function retrieves the cipher and key from the configuration, extracts the IV, HMAC,
 * and ciphertext from the decoded input, and then attempts to decrypt the ciphertext.
 * It also verifies the HMAC to ensure the data has not been tampered with.
 *
 * @param string $value The base64-encoded encrypted value to decrypt.
 * @return string The decrypted original text.
 * @throws Exception If the HMAC verification fails or decryption is unsuccessful.
 */

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