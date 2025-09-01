<?php
$data = validation(
    [
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|string',
        'mobile' => 'required|numeric|unique:users',
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


$data['password'] = bcrypt($data['password']);
//var_dump($data);
db_create('users', $data);
session_flash('old');
redirect(aurl('users'));
