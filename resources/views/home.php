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
    <form action="<?= url('upload') ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="formFileMultiple" class="form-label">Multiple files input example</label>
            <input class="form-control" type="file" name="images" id="formFileMultiple" multiple>
        </div>
        <input type="hidden" name="_method" value="post">
        <input type="submit" value="Upload Image" name="submit" class="btn btn-primary">
    </form>
</div>
<?php
view('layouts.footer', ['title' => 'Home Page']);

// echo $name;