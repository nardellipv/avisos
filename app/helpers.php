<?php

use Illuminate\Support\Facades\Auth;

function userConnect()
{
    return Auth::user();
}
