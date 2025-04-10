<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('userConnect')) {
    function userConnect()
    {
        return Auth::user();
    }
}
