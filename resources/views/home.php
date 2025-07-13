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
        if (all_errors()) {
            echo '<div class="alert alert-danger" role="alert"><ol>';
            foreach( all_errors() as $error):
                echo '<li>' . $error . '</li>';
                // foreach( $errors as $error):
                // endforeach;
            endforeach;
            echo "</ol></div>";
        }
    ?>
    <form action="<?= url('upload') ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input type="text" class="form-control" id="exampleFormControlInput1"  name="email" placeholder="name@example.com">
            <?php echo get_error('email');
            ?>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput01" class="form-label">mobile</label>
            <input type="text" class="form-control" id="exampleFormControlInput01" name="mobile" placeholder="00000000">
            <?php 
            foreach( any_errors('mobile') as $mobile):
                echo '<p>' . $mobile . '</p>';
            endforeach;
            ?>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput01" class="form-label">address</label>
            <input type="text" class="form-control" id="exampleFormControlInput01" name="address" placeholder="00000000">
            <?php 
            foreach( any_errors('address') as $address):
                echo '<p>' . $address . '</p>';
            endforeach;
            ?>
        </div>
        <input type="hidden" name="_method" value="post">
        <input type="submit" value="Upload Image" name="submit" class="btn btn-success">
    </form>
</div>
<?php
view('layouts.footer', ['title' => 'Home Page']);

// echo $name;