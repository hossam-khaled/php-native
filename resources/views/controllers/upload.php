<?php

// var_dump(request('images'));



//store_file(request('images'), 'images/'. request('images')['name']);
// store_file(request('images'), 'images/image.png');

validation('email','required|email', lang('main.email'));
// global $validations;
var_dump(any_errors('email'));

