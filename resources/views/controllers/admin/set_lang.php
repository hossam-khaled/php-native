<?php
// echo request('lang');die;
if (in_array(request('lang'), ['ar', 'en'])) {
    session('admin_lang', request('lang'));
}
redirect('/admin');
