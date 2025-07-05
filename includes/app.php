<?php
$helpers = array("request","routing","helper","AES","db", "session", "mail","translation","view") ;
foreach ($helpers as $helper) {
  require __DIR__ ."/helpers/". $helper .".php";
}
// include __DIR__ ."/helper.php";
// $database_info = include __DIR__ ."/../config/database.php";

$connect = mysqli_connect(
  config("database.servername"),
  config("database.username"),
  config("database.password"),
  config("database.database"),
  config("database.port"),
);
if ( !$connect ) {
  die("connection failed". mysqli_connect_error());
}

// include __DIR__ ."/db_helper.php";
// include __DIR__ ."/session_helper.php";

