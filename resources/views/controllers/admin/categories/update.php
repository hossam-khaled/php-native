<?php
$data = validation(
    [
        'name' => 'required|string',
        'icon' => 'image',
        'description' => 'required|string',
    ],
    [
        'name' => lang('cat.name'),
        'icon' => lang('cat.icon'),
        'description' => lang('cat.description'),
    ],
);

if (!empty($data['icon']['tmp_name'])) {
    $category = db_find('categories', request('id'));
    redirect_if(empty($category), aurl('categories'));
    delete_file($category['icon']);
    $file_info = file_exte($data['icon']);
    $data['icon'] = store_file($data['icon'], 'categories/' . $file_info['hash_name']);
} else {
    unset($data['icon']);
}

// var_dump($data);
db_update('categories', $data, request('id'));
// session_flash('old');
redirect(aurl('categories'));
