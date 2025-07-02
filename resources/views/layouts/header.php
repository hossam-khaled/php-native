<?php
if (session_has('locale')) {
  $lang = session('locale');
  $dir = session('locale') == 'ar' ? 'rtl' : 'ltr';
}else {
  $lang = 'en';
  $dir = 'ltr';
}
?>
<!doctype html>
<html lang="<?= $lang ?>" dir="<?= $dir ?>">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>php demo</title>

    <?php if(session_has('locale') == 'ar'): ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.rtl.min.css" integrity="sha384-Xbg45MqvDIk1e563NLpGEulpX6AvL404DP+/iCgW9eFa2BqztiwTexswJo2jLMue" crossorigin="anonymous">

    <?php else: ?>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <?php endif; ?>
  </head>
  <body>
        <?php view('layouts.navbar'); ?>