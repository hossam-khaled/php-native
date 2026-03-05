<?php
include 'admin.php';
// route_get('home', 'home');
// route_get('users', 'user');
route_get('lang', 'controllers.set_lang');
route_post('upload', 'controllers.upload');
route_get('/', 'front.home');
route_get('/category', 'front.categories.category');
route_get('/news', 'front.categories.news');
route_get('/contact', 'front.contact');
