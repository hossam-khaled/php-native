<?php
$GET_ROUTES = $routes['GET'] ?? [];
// $POST_ROUTES = $routes['POST'] ?? [];
/**
 * Handles the validation of the current URL segment against a list of allowed routes.
 *
 * - Calls the `sagment()` function to retrieve the current URL segment.
 * - If the segment is not null and does not exist in the `$GET_ROUTES` array (by comparing with the 'sagment' key),
 *   it outputs a "Page Not Found" message with the segment and terminates the script.
 * - Otherwise, it simply outputs the segment and terminates the script.
 *
 * Assumes:
 * - The `sagment()` function is defined elsewhere and returns the current URL segment.
 * - `$GET_ROUTES` is an array of routes, each containing a 'sagment' key.
 */
// var_dump(sagment());
if (!isset($_POST['_method']) && !is_null(sagment()) && !in_array(sagment(), array_column($GET_ROUTES, 'sagment'))) {
    $storage_psagment = str_replace('/'. public_().'/', '', sagment());
    if (preg_match('/storage/i', $storage_psagment)) {
        storage($storage_psagment);
    }else {
        view('404');
        exit;
    }
}
