<?php

$routes = [];
// global $routes;

if (!function_exists('route_get')) {
    function route_get($sagment, $view = null)
    {
        global $routes;
        $routes['GET'][] = [
            'view' => $view,
            'sagment' => '/' . ltrim($sagment, '/'),
        ];
    }
}

if (!function_exists('route_post')) {
    function route_post($sagment, $view = null)
    {
        global $routes;
        $routes['POST'][] = [
            'view' => $view,
            'sagment' => '/' . ltrim($sagment, '/'),
        ];
    }
}

if (!function_exists('route_init')) {
    function route_init()
    {
        global $routes;
        $sagment_uri = sagment();
        $GET_ROUTES = $routes['GET'] ?? [];
        $POST_ROUTES = $routes['POST'] ?? [];
        foreach ($GET_ROUTES as $rget) {
            if ($rget['sagment'] == $sagment_uri) {
                view($rget['view']);
            }
        }
        if (isset($_POST) && isset($_POST['_method']) && strtolower($_POST['_method']) == 'post' && count($_POST) > 0) {
            foreach ($POST_ROUTES as $rpost) {
                if ($rpost['sagment'] == $sagment_uri ) {
                    view($rpost['view']);
                }
            }
            if (!is_null(sagment()) && !in_array(sagment(), array_column($POST_ROUTES, 'sagment'))) {
                echo "<h1> 404 Page Not Found</h1>";
                exit;
            }
        }
    }
}

if (!function_exists('redirect')) {
    function redirect($path)
    {
        $url = url($path);
        header("Location: $url");
        exit;
    }

}
if (!function_exists('url')) {
    function url($path = '')
    {
        $base_url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        if (is_localhost()) {
            $base_url .= 'localhost/php-native/';
        } else {
            $base_url .= $_SERVER['HTTP_HOST'] . '/';
        }
        return rtrim($base_url, '/') . '/' . ltrim($path, '/');
    }
}
if (!function_exists('sagment')) {
    function sagment()
    {
        if (is_localhost()) {
            // var_dump($_SERVER['REQUEST_URI']);
            // die;
            $sagment = str_replace('/php-native', '', $_SERVER['REQUEST_URI']); // Remove leading and trailing slashes
            // $sagment = ltrim($_SERVER['REQUEST_URI'], '/'); // Remove leading and trailing slashes
            $sagment = explode('?', $sagment)[0]; // Remove query string if exists
            return !empty($sagment) ?  $sagment : null;
        } else {
            $sagment = ltrim($_SERVER['REQUEST_URI'], '/'); // Remove leading and trailing slashes
            $sagment = explode('?', $sagment)[0]; // Remove query string if exists
            return !empty($sagment) ? '/' . $sagment : null;
        }
        // echo ' <br>sagment <br>';

        // var_dump($sagment);
        // $sagment = explode('?', $sagment)[0]; // Remove query string if exists
        // return !empty($sagment) ? '/' . $sagment : null;
    }
}
