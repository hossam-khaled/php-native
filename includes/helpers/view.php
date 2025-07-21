<?php

if (!function_exists('view')) {
    /**
     * Renders a view file with the given data.
     *
     * @param string $view The name of the view file (without extension).
     * @param array $data Optional data to be passed to the view.
     * @return void
     */
    function view(string $path, array $data = [])
    {
        $viewPath = config('view.path') . '/' . str_replace('.', '/', $path) . '.php';

        if (file_exists($viewPath)) {
            extract($data);
            $view = $viewPath;
        } else {
            $view = config('view.path') . '/404.php';
        }

        view_engine($view);
    }
}

// view('home', ['name' => 'John Doe']);

if (!function_exists('view_engine')) {
    function view_engine(string $view)
    {
        $file_path = explode('/', $view);
        $file_name = end($file_path);
        $save_to_storage = base_path('storage/views/' . $file_name);
        // if (! file_exists($save_to_storage)) {
            $file = file_get_contents($view);
            $file = str_replace('{{', '<?php echo ', $file);
            $file = str_replace('}}', ' ;?>', $file);
            $file = str_replace('@php', '<?php ', $file);
            $file = str_replace('@endphp', ' ?>', $file);

            $file = preg_replace('/@if\((.*)\)/i', '<?php if($1): ?>', $file);
            $file = preg_replace('/@endif/i', '<?php endif; ?>', $file);

            $file = preg_replace('/@foreach\((.*?) as (.*?)\)+/i', '<?php foreach($1 as $2): ?>', $file);
            $file = preg_replace('/@endforeach/i', '<?php endforeach; ?>', $file);
            file_put_contents($save_to_storage, $file);
        // }


        include $save_to_storage;
    }
}
