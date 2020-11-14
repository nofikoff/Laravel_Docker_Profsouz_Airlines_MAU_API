<?php

use \Modules\Documents\Http\Controllers\DocumentsController;

Route::get('documents/file/{hash}',
    [DocumentsController::class, 'docFromHash'])
    ->name('download.document');

Route::get('documents/download/{id}', [DocumentsController::class, 'download'])->name('documents.download')->middleware('web');

Route::group([
    'middleware' => ['web', 'auth', 'confirmed_user'],
    'prefix'     => 'documents',
    'namespace'  => 'Modules\Documents\Http\Controllers'
], function () {
    Route::get('/', 'DocumentsController@index')->name('documents.index');
    Route::get('/search', 'DocumentsController@search')->name('documents.search');

    Route::get('premoderate', 'DocumentsController@premoderate')->name('documents.premoderate');

    Route::get('create', 'DocumentsController@create')->name('documents.create');

    Route::post('create', 'DocumentsController@store');

    Route::post('destroy', 'DocumentsController@destroy')->name('documents.destroy');

    Route::get('user/{user_id}', 'DocumentsController@user')->name('documents.user');

    Route::get('/{id}', 'DocumentsController@edit')->name('documents.edit');

    Route::post('/{id}', 'DocumentsController@update');

    Route::get('branch/{branch_alias}', 'DocumentsController@branch')->name('documents.branches.item');

    Route::get('tag/{tag_alias}', 'DocumentsController@tag')->name('documents.tags.item');
});
