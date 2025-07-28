<?php

$routes = [];
// global $routes;

/**
 * Registers a new GET route.
 *
 * Adds a route definition to the global $routes array for HTTP GET requests.
 *
 * @param string $sagment The URI segment for the route (leading slash is optional).
 * @param mixed $view The view or handler associated with the route (optional).
 */
if (!function_exists('route_get')) {
    function route_get($sagment, $view = null)
    {
        global $routes;
        $routes['GET'][] = [
            'view' => $view,
            'sagment' => '/' . public_() . '/' . ltrim($sagment, '/'),
        ];
    }
}

/**
 * Registers a POST route with the specified URI segment and optional view.
 *
 * Adds a new route to the global $routes array for HTTP POST requests.
 *
 * @param string $sagment The URI segment for the route (leading slash is ensured).
 * @param mixed $view Optional. The view or handler associated with the route.
 *
 * @global array $routes The global routes array where the route will be registered.
 */
if (!function_exists('route_post')) {
    function route_post($sagment, $view = null)
    {
        global $routes;
        $routes['POST'][] = [
            'view' => $view,
            'sagment' => '/' . public_() . '/' . ltrim($sagment, '/'),
        ];
    }
}
/**
 * Initializes the routing system for the application.
 *
 * This function checks the current URI segment and matches it against the defined GET and POST routes.
 * - For GET requests, it searches for a matching route and renders the associated view.
 * - For POST requests (identified by the presence of a '_method' field set to 'post' in $_POST), 
 *   it searches for a matching POST route and renders the associated view.
 * - If a POST request is made to a non-existent route, it displays a 404 error message and exits.
 *
 * Globals:
 *   - $routes: An array containing route definitions for 'GET' and 'POST' methods.
 *
 * Dependencies:
 *   - sagment(): Function that returns the current URI segment.
 *   - view($view): Function that renders the specified view.
 *
 * Outputs:
 *   - Renders the appropriate view for the matched route.
 *   - Displays a 404 error message if no matching POST route is found.
 */

if (!function_exists('route_init')) {
    function route_init()
    {
        global $routes;
        $sagment_uri = sagment();
        $GET_ROUTES = $routes['GET'] ?? [];
        $POST_ROUTES = $routes['POST'] ?? [];
        if (!isset($_POST['_method'])) {
            foreach ($GET_ROUTES as $rget) {
                if ($rget['sagment'] == $sagment_uri) {
                    view($rget['view']);
                }
            }
        }
        if (isset($_POST) && isset($_POST['_method']) && strtolower($_POST['_method']) == 'post' && count($_POST) > 0) {
            foreach ($POST_ROUTES as $rpost) {
                if ($rpost['sagment'] == $sagment_uri) {
                    view($rpost['view']);
                }
            }
            if (!is_null(sagment()) && !in_array(sagment(), array_column($POST_ROUTES, 'sagment'))) {
                view('404');
                exit;
            }
        }
    }
}

if (!function_exists('redirect')) {
    /**
     * Redirects the user to a specified path.
     *
     * Generates a full URL from the given path using the `url()` helper,
     * sends an HTTP Location header to redirect the client, and terminates script execution.
     *
     * @param string $path The path to redirect to.
     * @return void
     */
    function redirect($path)
    {
        $check_path = parse_url($path);
        if (isset($check_path['scheme']) and isset($check_path['host'])) {
            header("Location: ". $path['scheme'] .'://'.$path['host'] . $path['path']);
        }else{
            header("Location: ". url($path));
        }
        exit;
    }
}

if (!function_exists('back')) {
    function back()
    {
        header(header: "Location:" . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
if (!function_exists('url')) {
    /**
     * Generates a full URL based on the given path and the current server environment.
     *
     * Determines the base URL by checking if the connection is secure (HTTPS) and whether
     * the application is running on localhost. If on localhost, it appends the local project
     * directory to the base URL. Otherwise, it uses the HTTP_HOST value.
     *
     * @param string $path Optional. The path to append to the base URL. Default is an empty string.
     * @return string The fully constructed URL.
     */
    function url($path = '')
    {
        $base_url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        if (is_localhost()) {
            $base_url .= 'localhost/php-native/';
        } else {
            $base_url .= $_SERVER['HTTP_HOST'] . '/';
        }
        return rtrim($base_url, '/') . '/' . public_() . '/' . ltrim($path, '/');
    }
}


if (!function_exists('aurl')) {
    function aurl($path = '')
    {
        $base_url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        if (is_localhost()) {
            $base_url .= 'localhost/php-native/';
        } else {
            $base_url .= $_SERVER['HTTP_HOST'] . '/';
        }
        return rtrim($base_url, '/') . '/' . public_() . '/' . ADMIN . '/' . ltrim($path, '/');
    }
}

if (!function_exists('sagment')) {
    /**
     * Retrieves and processes the current request URI segment.
     *
     * This function returns the path segment of the current request URI,
     * handling differences between localhost and production environments.
     * - On localhost, it removes the '/php-native' base path from the URI.
     * - On production, it trims the leading slash from the URI.
     * In both cases, it removes any query string from the URI.
     *
     * @return string|null The processed URI segment, or null if empty.
     */
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
