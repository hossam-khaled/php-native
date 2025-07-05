<?php
include(__DIR__ . "/includes/app.php");
include(__DIR__ . "/routes/web.php");
// Set session save path and start the session
session_save_path(config("session.sessions_save_path"));
ini_set('session.gc_probability', '1');
session_start([
  "cookie_lifetime" => config("session.expiration_timeout"),
]);

include(__DIR__ . "/includes/exception_error.php");

// var_dump( db_create(
//   'users',
//   array(
//     'name' => 'hossam',
//     'email' => 'hossam@email.com',
//     'password' => '123456',
//     'mobile' => '111111',
//   )
// ));

// var_dump(db_update('users',
//   array(
//     'name' => 'hossam1111',
//     'email' => 'hossam@email.com',
//     'password' => '123456',
//     'mobile' => '111111',
//   ),
//   12));
// db_delete("users",11);
// var_dump(db_find("users","10"));
// var_dump(db_search("users","where name='hossam'"));


// $users = db_paginate('users','',2);
// var_dump($users);
// if ($users['num'] > 0 ) {
//   while ($row = mysqli_fetch_assoc($users['query'])) {
//     echo $row['name'] .'<br>';
//   }

// }
// echo $users['render'];
//  send mail
//send_mail(['hossam.khaled.host@gmail'],'this is test','my first test mail')
ob_start();


// session("hos" , 'this new hos test');

// echo session('hos');
// session_forget('hos');

$data = aes_encrypt('this is a test value');
aes_decrypt($data);
route_init();

if( !empty($GLOBALS["query"])) {
  mysqli_free_result($GLOBALS["query"]); 
}
  mysqli_close($GLOBALS["connect"]);

ob_end_flush();