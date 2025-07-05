<?php
/**
 * Retrieves a translated string based on the given key and replaces placeholders with provided values.
 *
 * This function looks up a translation string from a locale-specific PHP file using a dot-notated key (e.g., "messages.welcome").
 * It supports dynamic locale selection from the session or configuration, and allows for placeholder replacement within the translation.
 *
 * @param string $key The translation key in the format "file.key" (e.g., "messages.welcome").
 * @param array $replace An associative array of placeholders and their replacements (e.g., [':name' => 'John']).
 * @return string The translated string with placeholders replaced, or an error message if the translation or file is not found.
 */
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
/**
 * Sets the application's locale by storing the specified language code in the session.
 *
 * @param string $lang The language code to set as the current locale (e.g., 'en', 'fr', 'es').
 *
 * @return void
 */
if (!function_exists('set_locale')) {
    function set_locale(string $lang)
    {
        session('locale', $lang);
    }
}

