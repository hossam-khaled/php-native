<?php

// route_get('home', 'home');
route_get('/','home');
route_get('users','user');
route_get('lang', 'controllers.set_lang');
route_post('upload', 'controllers.upload');