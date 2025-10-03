<?php
$category = db_find('categories', request('id'));
view('front.layouts.header', ['title' => $category['name']]);
redirect_if(empty($category), url('/404'));
?>
<h1><?= $category['name'] ?></h1>