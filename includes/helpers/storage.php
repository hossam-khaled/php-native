<?php
if(!function_exists('storage')){
    function storage($path){
        if (file_exists($path)) {

            $mime = mime_content_type($path);
            header('Content-Type: ' . $mime);
            header('Content-Disposition: File from server');
            header('expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($path));
            readfile($path);
        }else{
            view('404');
        }        
        exit;
    }
}
if(!function_exists('delete_file')){
    function delete_file($path){
        if (file_exists($path)) {
            return unlink($path);
        }
        return false; // File does not exist
        
    }
}
if(!function_exists('remove_folder')){
    // function remove_folder($path){
    //     if (is_dir($path)) {
    //         return rmdir($path);
    //     }
    //     return false; // File does not exist
        
    // }

    function remove_folder($dir) {
    if (!file_exists($dir)) return false;
    if (!is_dir($dir)) return unlink($dir);
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') continue;
        if (!remove_folder($dir . DIRECTORY_SEPARATOR . $item)) return false;
    }
    return rmdir($dir);
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