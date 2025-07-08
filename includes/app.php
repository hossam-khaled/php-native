<?php
ob_start();

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

/**
 * Initializes PHP session handling with custom configuration.
 *
 * - Sets the session save path using the value from the application's configuration.
 * - Configures the session garbage collection probability to 1, ensuring cleanup runs on every request.
 * - Starts the session with a custom cookie lifetime, as specified in the configuration.
 *
 * @see config("session.sessions_save_path") for the session storage path.
 * @see config("session.expiration_timeout") for the session cookie lifetime.
 */
session_save_path(config("session.sessions_save_path"));
ini_set('session.gc_probability', '1');


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

include(base_path('/routes/web.php'));
include(base_path('/includes/exception_error.php'));
