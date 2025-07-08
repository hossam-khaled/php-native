<?php
include(__DIR__ . "/../includes/app.php");

session_start([
  "cookie_lifetime" => config("session.expiration_timeout"),
]);

if (!is_link(public_path('storage'))) {
  symlink(base_path('storage/files'), public_path('storage'));
}
// delete_file(public_path('storage/images/image.png'));
route_init();
// remove_folder('storage/images');
if( !empty($GLOBALS["query"])) {
  mysqli_free_result($GLOBALS["query"]); 
}
  mysqli_close($GLOBALS["connect"]);

ob_end_flush();