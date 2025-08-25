<?php
$data = validation(
    [
        'title' => 'required|string',
        'image' => 'required|image',
        'description' => '',
        'content' => 'required|string',
        'category_id' => 'required|int',
        'user_id' => 'required|int',
    ],
    [
        'title' => lang('news.title'),
        'image' => lang('news.image'),
        'description' => lang('news.description'),
        'content' => lang('news.content'),
        'category_id' => lang('news.category_id'),
        'user_id' => lang('news.user_id')
    ],
);

$file_info = file_exte($data['image']);
$data['image'] = store_file($data['image'], 'news/' . $file_info['hash_name']);
$data['created_at'] = date('Y-m-d h:i:s');
$data['updated_at'] = date('Y-m-d h:i:s');
//var_dump($data);
db_create('news', $data);
session_flash('old');
redirect(aurl('news'));