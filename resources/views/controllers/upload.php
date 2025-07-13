<?php

// var_dump(request('images'));



//store_file(request('images'), 'images/'. request('images')['name']);
// store_file(request('images'), 'images/image.png');

validation(
    [
        'email' => 'required|email',
        'mobile' => 'required|integer',
        'address' => 'required|string',
    ],
    [
        'email' => lang('main.email'),
        'mobile' => lang('main.mobile'),
        'address' => lang('main.address'),
    ]
);


if (any_errors() !== null and count(any_errors()) > 0) {
    redirect('/');
}
