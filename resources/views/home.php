<?php
view('layouts.header', ['title' => lang('main.home') ]);
// set_locale('ar'); // Set locale to Arabic
// var_dump(lang('main.home')); // Example usage
echo "<h1>". lang('main.home') ." ". lang('main.page') ."</h1>
<p>". lang('main.welcome')."</p>
<br>";
if (session_has('success')) {
    echo "<p style='color: green;'>" . session_flash('success') . "</p>";
}
?>


<?php
view('layouts.footer', ['title' => 'Home Page']);

// echo $name;