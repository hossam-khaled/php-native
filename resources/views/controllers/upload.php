<?php

// var_dump(request('images'));



//store_file(request('images'), 'images/'. request('images')['name']);
// store_file(request('images'), 'images/image.png');

$data = validation(
    [
        'email' => 'required|email',
        'mobile' => 'required|numeric',
        'address' => 'required|string',
    ],
    [
        'email' => lang('main.email'),
        'mobile' => lang('main.mobile'),
        'address' => lang('main.address'),
    ]
);


var_dump( $data );
session_flash('old');