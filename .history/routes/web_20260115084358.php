<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('portofolio');
});

Route::get('/project', function () {
    return view('project');
});