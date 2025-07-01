<?php

if (!function_exists('view')) {
    /**
     * Renders a view file with the given data.
     *
     * @param string $view The name of the view file (without extension).
     * @param array $data Optional data to be passed to the view.
     * @return void
     */
    function view(string $path,array $data = [])
    {   
        // echo 'view <br>';
        // var_dump($path);
        $full_path = '';
        $current_path = explode('.', $path);
        foreach ($current_path as $current) {
            if (end($current_path) === $current) {
                $full_path .= '/' . $current;
            }
            
        }
        $viewPath = config('view.path') . '/' . $full_path . '.php';
        if (file_exists($viewPath)) {
            extract($data);
            require $viewPath;
        } else {
            include_once config('view.path') . '/404.php';
        }
    }
}

// view('home', ['name' => 'John Doe']);