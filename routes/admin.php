<?php

define('ADMIN', 'admin');


route_get(ADMIN . '', 'admin.index');
route_get(ADMIN . '/', 'admin.index');
route_get(ADMIN . '/lang', 'controllers.admin.set_lang');

// login authentication
route_get(ADMIN . '/login', 'admin.login');
route_get(ADMIN . '/logout', 'controllers.admin.logout');
route_post(ADMIN . '/do/login', 'controllers.admin.login');


route_get(ADMIN . '/categories', 'admin.categories.index');
route_get(ADMIN . '/categories/create', 'admin.categories.create');
route_post(ADMIN . '/categories/add', 'controllers.admin.categories.add');
route_get(ADMIN . '/categories/edit', 'admin.categories.edit');
route_get(ADMIN . '/categories/delete', 'admin.categories.delete');