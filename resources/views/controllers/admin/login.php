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

// var_dump(bcrypt($data['password']));
// die();
$find = db_search('users', "where email LIKE '%" . $data['email'] . "%'");
// var_dump($find['password'], $data['password']);
if (empty($find) || (!verify_bcrypt($data['password'], $find['password']) || $find['user_type'] != 'admin')) {
    session('error_login', lang('admin.login_failed'));
    back();
} else {
    session('admin', json_encode($find));
    redirect(ADMIN);
}
// session_flash('old');