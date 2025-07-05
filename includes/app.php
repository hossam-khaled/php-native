<?php
/**
 * Loads a set of helper PHP files required for the application.
 *
 * This script defines an array of helper names and iterates through each,
 * requiring the corresponding PHP file from the 'helpers' directory.
 *
 * Helpers included:
 * - request: Handles HTTP request data.
 * - routing: Manages URL routing and dispatching.
 * - helper: Contains general utility functions.
 * - AES: Provides AES encryption and decryption utilities.
 * - db: Database connection and query helpers.
 * - session: Session management utilities.
 * - mail: Email sending functionality.
 * - translation: Language translation helpers.
 * - view: View rendering utilities.
 *
 * @see /helpers directory for the implementation of each helper.
 */
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

