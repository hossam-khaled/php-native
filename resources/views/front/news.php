<?php
$news = db_find('news', request('id'));
view('front.layouts.header', ['title' => $news['name']]);
?>
<h1><?= $news['name'] ?></h1>