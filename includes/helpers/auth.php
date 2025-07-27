<?php

if (!function_exists('auth')) {
    function auth() {
        return session_has('admin') ? json_decode(session('admin'), true) : null;
    }
}


if (!function_exists('logout')) {
    function logout() {
        session_forget('admin');
    }
}