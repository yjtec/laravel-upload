<?php

Route::get('/kd/upload', function () {
    echo 'uplaod test';
});
Route::prefix(config('upload.api_prefix'))->get('/kd/controller', 'Kd\Upload\Controllers\IndexController@index');
Route::prefix(config('upload.api_prefix'))->post('/kd/upload', 'Kd\Upload\Controllers\IndexController@upload');
