<?php
return [
    "expiration_timeout"=> 86400,
    "sessions_save_path"=> base_path("storage/sessions"),
    "encrypt_key"=> "php_Hossam_Khaled_123456", // Must be 16 bytes for AES-128
    "encrypt_cipher"=> "AES-128-CBC",
];