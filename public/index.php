<?php
include(__DIR__ . "/../includes/app.php");

session_start([
  "cookie_lifetime" => config("session.expiration_timeout"),
]);


route_init();

if( !empty($GLOBALS["query"])) {
  mysqli_free_result($GLOBALS["query"]); 
}
  mysqli_close($GLOBALS["connect"]);

ob_end_flush();