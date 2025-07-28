<?php
$data = validation(
    [
        'name' => 'required|string',
        'icon' => 'required|image',
        'description' => 'required|string',
    ],
    [
        'name' => lang('cat.name'),
        'icon' => lang('cat.icon'),
        'description' => lang('cat.description'),
    ],
);

$file_info = file_exte( $data['icon'] );
$data['icon'] = store_file($data['icon'] , 'categories/' . $file_info['hash_name'] );

//var_dump($data);
db_create('categories', $data);
session_flash('old');
redirect(aurl('categories') );