<?php
$data = validation(
    [
        'title' => 'required|string',
        // 'image' => 'required|image',
        'description' => '',
        'content' => 'required|string',
        'category_id' => 'required|int',
        // 'user_id' => 'required|int',
    ],
    [
        'title' => lang('news.title'),
        // 'image' => lang('news.image'),
        'description' => lang('news.description'),
        'content' => lang('news.content'),
        'category_id' => lang('news.category_id'),
        // 'user_id' => lang('news.user_id')
    ],
);

if (!empty($data['image']['tmp_name'])) {
    $news = db_find('news', request('id'));
    redirect_if(empty($news), aurl('news'));
    delete_file($news['image']);
    $file_info = file_exte($data['image']);
    $data['image'] = store_file($data['image'], 'news/' . $file_info['hash_name']);
    $data['user_id'] = auth()['id'];
    $data['updated_at'] = date('Y-m-d h:i:s');
} else {
    unset($data['image']);
}


//var_dump($data);
db_update('news', $data, request('id'));

session_flash('old');
redirect(aurl('news'));