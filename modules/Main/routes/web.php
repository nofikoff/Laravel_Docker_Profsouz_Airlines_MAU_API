<?php

Route::group(['middleware' => ['web', 'auth', 'confirmed_user'], 'namespace' => 'Modules\Main\Http\Controllers'], function()
{
    Route::get('/search', 'SearchController@index')->name('search');
    Route::post('image-upload', 'UploadImageController@store')->name('image_upload');

    Route::get('/page/{alias}', 'PageController@show')->name('page.show');
});