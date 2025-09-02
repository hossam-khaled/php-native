<?php
$data = validation(
    [
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email,'. request('id'),
        'password' => '',
        'mobile' => 'required|numeric|unique:users,mobile,'. request('id'),
        'user_type' => 'required|string|in:admin,user',
    ],
    [
        'name' => lang('user.name'),
        'email' => lang('user.email'),
        'password' => lang('user.password'),
        'mobile' => lang('user.mobile'),
        'user_type' => lang('user.user_type'),
    ],
);

if (!empty($data['password'])) {
    $data['password'] = bcrypt($data['password']);
}else{
    unset($data['password']);
}


// var_dump($data);
db_update('users', $data, request('id'));
session_forget('old');
session('success', lang('admin.updated'));

redirect(aurl('users'));
