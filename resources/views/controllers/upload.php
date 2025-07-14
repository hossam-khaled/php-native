<?php

// var_dump(request('images'));



//store_file(request('images'), 'images/'. request('images')['name']);
// store_file(request('images'), 'images/image.png');

$data = validation(
    [
        'email' => 'required|email',
        'mobile' => 'required|integer',
        'address' => 'required|string',
    ],
    [
        'email' => lang('main.email'),
        'mobile' => lang('main.mobile'),
        'address' => lang('main.address'),
    ],
    '11'
);


var_dump( $data );