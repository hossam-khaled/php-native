<?php
$data = validation(
    [
        'name' => 'required|string',
        'email' => 'required|email',
        'password' => 'required|string',
        'mobile' => 'required|numeric',
        'user_type' => 'required|string',
    ],
    [
        'name' => lang('user.name'),
        'email' => lang('user.email'),
        'password' => lang('user.password'),
        'mobile' => lang('user.mobile'),
        'user_type' => lang('user.user_type'),
    ],
);



//var_dump($data);
db_create('users', $data);
session_flash('old');
redirect(aurl('users'));
