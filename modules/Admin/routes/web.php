<?php

Route::group([
    'middleware' => ['web', 'auth', 'lang', 'admin'],
    'prefix'     => 'admin',
    'namespace'  => 'Modules\Admin\Http\Controllers'
],
    function () {

        Route::get('/', 'AdminController@index')->name('admin');

        //GROUP
        Route::get('/groups/create', 'GroupController@create')->name('admin.group.create');
        Route::post('/groups/create', 'GroupController@store');

        Route::get('/groups', 'GroupController@index')->name('admin.group.list');

        Route::get('/groups/{id}', 'GroupController@edit')->name('admin.group.edit');
        Route::post('/groups/{id}', 'GroupController@update');

        Route::post('/groups/{id}/destroy', 'GroupController@destroy')->name('admin.group.destroy');

        Route::post('/groups/{id}/user', 'GroupController@updateUser')->name('admin.group.user');

        //BRANCH
        Route::get('/branches', 'BranchController@index')->name('admin.branch.list');

        Route::get('/branch/create', 'BranchController@create')->name('admin.branch.create');
        Route::post('/branch/create', 'BranchController@store');

        Route::get('/branch/{id}', 'BranchController@edit')->name('admin.branch.edit');
        Route::post('/branch/{id}', 'BranchController@update');

        Route::post('/branch/{id}/delete', 'BranchController@destroy')->name('admin.branch.destroy');

        Route::get('/branch/{id}/groups', 'BranchController@getGroups')->name('admin.branch.groups');
        Route::post('/branch/{id}/groups', 'BranchController@updateGroups');

        //INFOSTATUS
        Route::get('/info_statuses', 'InfoStatusController@index')->name('admin.infostatus.list');

        Route::get('/info_status/create', 'InfoStatusController@create')
            ->name('admin.infostatus.create');
        Route::post('/info_status/create', 'InfoStatusController@store');

        Route::get('/info_status/{id}', 'InfoStatusController@edit')->name('admin.infostatus.edit');
        Route::post('/info_status/{id}', 'InfoStatusController@update');

        Route::post('/info_status/{id}/delete', 'InfoStatusController@destroy')
            ->name('admin.infostatus.delete');

        //LOG
        Route::get('/logs', 'LogController@index')->name('admin.logs');
        //TAGS
        Route::get('/tags', 'TagController@index')->name('admin.tag.list');

        Route::get('/tag/create', 'TagController@create')->name('admin.tag.create');
        Route::post('/tag/create', 'TagController@store')->name('admin.tag.store');

        Route::get('/tag/{id}', 'TagController@edit')->name('admin.tag.edit');
        Route::post('/tag/{id}', 'TagController@update')->name('admin.tag.update');

        Route::post('/tag/{id}/delete', 'TagController@destroy')->name('admin.tag.destroy');

        Route::group(['prefix' => 'documents'], function () {
            Route::get('/list', 'DocumentController@index')->name('admin.document.list');

            Route::get('/create', 'DocumentController@create')->name('admin.document.create');
            Route::post('/create', 'DocumentController@store');

            Route::get('/search', 'DocumentController@search')->name('admin.document.search');

            Route::post('/destroy', 'DocumentController@destroy')->name('admin.document.destroy');

            Route::get('/{id}', 'DocumentController@edit')->name('admin.document.edit');
            Route::post('/{id}', 'DocumentController@update');
        });

        Route::group(['prefix' => 'premoderate'], function () {
            Route::get('/list', 'PremoderateController@index')->name('admin.premoderate.list');
            Route::post('/action', 'PremoderateController@action')->name('admin.premoderate.action');
        });

        Route::group(['prefix' => 'votes'], function () {
            Route::get('/list', 'VoteController@index')->name('admin.vote.list');
            Route::post('/action', 'VoteController@setWinner')->name('admin.vote.action');
        });

        Route::group(['prefix' => 'users'], function () {

            Route::get('/list', 'UsersController@index')->name('admin.users.list');
            Route::get('/list/verified', 'UsersController@showVerified')->name('admin.users.verified');
            Route::get('/list/not_verified', 'UsersController@showNotVerified')
                ->name('admin.users.not_verified');
            Route::get('/search', 'UsersController@search')->name('admin.users.search');

            Route::get('/{user_id}', 'UsersController@edit')->name('admin.users.item');
            Route::post('/{user_id}', 'UsersController@update');
            Route::post('/{user_id}/roles', 'UsersController@updateRoles')->name('admin.users.roles');
            Route::post('/{user_id}/confirm', 'UsersController@confirm')->name('admin.users.confirm');
        });

        Route::resource('pages', 'PageController', [
            'as' => 'admin'
        ]);

        Route::group(['prefix' => 'pages', 'as' => 'admin.pages.'], function() {
            Route::get('{page}/up', 'PageController@up')->name('up');
            Route::get('{page}/down', 'PageController@down')->name('down');
        });

        Route::group(['prefix' => 'finn_types', 'as' => 'admin.finn_types.'], function () {
            Route::get('/', 'FinnTypeController@index')->name('index');

            Route::get('/create', 'FinnTypeController@create')->name('create');
            Route::post('/create', 'FinnTypeController@store');

            Route::get('/{finnType}/edit', 'FinnTypeController@edit')->name('edit');
            Route::post('/{finnType}/edit', 'FinnTypeController@update');

            Route::post('/{finnType}/delete', 'FinnTypeController@destroy')->name('delete');
        });

    });
