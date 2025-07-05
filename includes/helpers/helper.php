<?php

/**
 * Retrieves a configuration value from a configuration file.
 *
 * Given a dot-notated key (e.g., "app.name"), this function loads the corresponding
 * configuration file from the /config directory and returns the value associated with the specified key.
 *
 * @param string $key Dot-notated configuration key (e.g., "filename.key").
 * @return mixed|null The configuration value if found, or null if not found.
 */
if(!function_exists("config")){
    function config(string $key){
        $config = explode(".", $key);
        if(count($config) > 0){
            $return = include base_path('/config/' . $config['0']) . '.php'; 
            return $return[$config[1]];
        }
        return null;
    }
}
/**
 * Returns the absolute path by appending the given relative path to the current working directory.
 *
 * @param string $path The relative path to append to the base path.
 * @return string The absolute path constructed from the current working directory and the given path.
 */

if(!function_exists('base_path')){
    function base_path($path) {
        return getcwd() . '/' . $path ;
    }
}
/**
 * Checks if the current request is being made from a localhost environment.
 *
 * This function determines if the application is running on localhost by checking
 * the HTTP_HOST server variable for 'localhost', '127.0.0.1', or '::1'.
 *
 * @return bool Returns true if the request is from localhost, otherwise false.
 */

if(!function_exists('is_localhost')){
    function is_localhost() {
        if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false || $_SERVER['HTTP_HOST'] == '127.0.0.1' || $_SERVER['HTTP_HOST'] == '::1') {
            return true;
        }
        return false;
    }
}


