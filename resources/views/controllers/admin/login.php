<?php
$data = validation(
    [
        'email' => 'required|email',
        'password' => 'required',
        'remember_me' => '',
    ],
    [
        'email' => lang('main.email'),
        'password' => lang('main.password'),
    ],
);


var_dump(bcrypt($data['password']));
session_flash('old');
