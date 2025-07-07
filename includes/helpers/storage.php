<?php
if(!function_exists('storage')){
    function storage($path){
        return config('files.storage_files_path') . '/' . $path;
    }
}

if(!function_exists('store_file')){
    function store_file($from, $to){
        if( isset($from['tmp_name']) ) {

            $to_path = '/' . ltrim($to, '/');
            $path = config('files.storage_files_path') . $to_path;
            $ex_path = explode('/', $path);
            $end_path = end($ex_path);
            $dir_path = str_replace($end_path, '', $path);
            if(!is_dir($dir_path)){
                mkdir($dir_path,0777, true);
            }
            move_uploaded_file($from['tmp_name'], $path);
            return true; 
        }
        return false;
    }
}