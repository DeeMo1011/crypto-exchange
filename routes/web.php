<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home'); // ใช้หน้า home.blade.php ที่เราสร้าง
});
