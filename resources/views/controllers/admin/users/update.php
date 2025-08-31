<?php
$data = validation(
    [
        'name' => 'required|string',
        'email' => 'required|email',
        'mobile' => 'required|numeric',
        'user_type' => 'required|string',
    ],
    [
        'name' => lang('user.name'),
        'email' => lang('user.email'),
        'mobile' => lang('user.mobile'),
        'user_type' => lang('user.user_type'),
    ],
);



// var_dump($data);
db_update('users', $data, request('id'));
// session_flash('old');
redirect(aurl('users'));
