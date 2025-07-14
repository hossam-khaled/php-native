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
    <?php
    // var_dump(any_errors());
    //echo get_error();
    $validat_email = get_error('email');
    $validat_mobile = get_error('mobile');
    $validat_address = get_error('address');
    if (!empty(any_errors())) {
        session_flash('errors');
    }
    ?>
    <form action="<?= url('upload') ?>" method="post" enctype="multipart/form-data" class="needs-validation">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input type="text" class="form-control <?= !empty($validat_email) ? 'is-invalid' : 'is-valid' ?>" name="email" placeholder="name@example.com" >

            <div class="<?= !empty($validat_email) ? 'invalid-feedback' : 'valid-feedback' ?>">
                <?= $validat_email; ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput01" class="form-label">mobile</label>
            <input type="text" class="form-control <?= !empty($validat_mobile) ? 'is-invalid' : 'is-valid' ?>" name="mobile" placeholder="00000000" >
            <div class="<?= !empty($validat_mobile) ? 'invalid-feedback' : 'valid-feedback' ?>">
                <?= $validat_mobile; ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput01" class="form-label">address</label>
            <input type="text" class="form-control <?= !empty($validat_address) ? 'is-invalid' : 'is-valid' ?>" name="address" placeholder="adress" >
            <div class="<?= !empty($validat_address) ? 'invalid-feedback' : 'valid-feedback' ?>">
                <?= $validat_address; ?>
            </div>
        </div>
        <input type="hidden" name="_method" value="post">
        <input type="submit" value="Upload Image" name="submit" class="btn btn-success">
    </form>
</div>
<?php
view('layouts.footer', ['title' => 'Home Page']);

// echo $name;