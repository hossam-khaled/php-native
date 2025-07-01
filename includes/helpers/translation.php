<?php
if (!function_exists('lang')) {
    function lang(string $key, array $replace = []): string
    {
        if (session_has('locale')) {
            $locale = session('locale');
        } else {
            $locale = !empty(config('lang.default')) ? config('lang.default') : config('lang.fallback');
        }
        $trans = explode('.', $key);
        $path = config('lang.path') . '/' . $locale . '/'. $trans[0] .'.php';
        // return $path;
        if (!file_exists($path)) {
            return "Translation file for locale '{$locale}' not found.";
        }

        $translations = include $path;

        if (!isset($translations[$trans[1]])) {
            return "Translation for key '{$trans[1]}' not found.";
        }

        $translation = $translations[$trans[1]];

        foreach ($replace as $search => $value) {
            $translation = str_replace( $search, $value, $translation);
            // var_dump($translation, $value);
        }

        return $translation;
    }
}
if (!function_exists('set_locale')) {
    function set_locale(string $lang)
    {
        session('locale', $lang);
    }
}

