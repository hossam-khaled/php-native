<?php

define('ADMIN', 'admin');


route_get(ADMIN . '', 'admin.index');
route_get(ADMIN . '/', 'admin.index');
route_get(ADMIN . '/lang', 'controllers.admin.set_lang');

// login authentication
route_get(ADMIN . '/login', 'admin.login');
route_get(ADMIN . '/logout', 'controllers.admin.logout');
route_post(ADMIN . '/do/login', 'controllers.admin.login');