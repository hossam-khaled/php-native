<?php
// echo request('lang');die;
if (in_array(request('lang'), ['ar', 'en'])) {
    session('locale', request('lang'));
}
back();