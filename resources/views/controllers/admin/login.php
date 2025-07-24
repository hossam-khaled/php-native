<?php
$data = validation(
    [
        'email' => 'required|email',
        'password' => 'required',
    ],
    [
        'email' => lang('main.email'),
        'password' => lang('main.password'),
    ],
    'redirect',
    ADMIN . '/login'
);


var_dump($data);
session_flash('old');
