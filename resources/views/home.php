<?php
view('layouts.header', ['title' => lang('main.home')]);
// set_locale('ar'); // Set locale to Arabic
// var_dump(lang('main.home')); // Example usage
echo "<h1>" . lang('main.home') . " " . lang('main.page') . "</h1>
<p>" . lang('main.welcome') . "</p>
<br>";
if (session_has('success')) {
    echo "<p style='color: green;'>" . session_flash('success') . "</p>";
}
?>
<div class="container">
    <a href="<?= url('storage/images/image.png'); ?>" class="btn btn-primary">image</a>
    <form action="<?= url('upload') ?>" method="post" enctype="multipart/form-data">
      
        <input class="form-control" type="text" name="email" >
        <input type="hidden" name="_method" value="post">
        <input type="submit" value="Upload Image" name="submit" class="btn btn-primary">
    </form>
</div>
<?php
view('layouts.footer', ['title' => 'Home Page']);

// echo $name;