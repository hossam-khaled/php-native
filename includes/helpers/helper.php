<?php

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

if(!function_exists('base_path')){
    function base_path($path) {
        return getcwd() . '/' . $path ;
    }
}

if(!function_exists('is_localhost')){
    function is_localhost() {
        if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false || $_SERVER['HTTP_HOST'] == '127.0.0.1' || $_SERVER['HTTP_HOST'] == '::1') {
            return true;
        }
        return false;
    }
}


