<?php

Route::get('api/pdf/{hash}', [\Modules\Posts\Http\Controllers\PostsController::class, 'pdfFromHash'])
    ->name('download.pdf');

Route::get('api/attachment/{hash}', [\Modules\Posts\Http\Controllers\PostsController::class, 'attachFromHash'])
    ->name('download.attachment');

Route::group([
    'middleware' => ['web', 'auth', 'confirmed_user'],
    'prefix'     => 'posts',
    'namespace'  => 'Modules\Posts\Http\Controllers'
],
    function () {
        Route::get('', 'PostsController@index')->name('posts.index');

        Route::get('my', 'UserController@index')->name('posts.my');

        Route::get('premoderate', 'PostsController@premoderate')->name('posts.premoderate');

        Route::get('branches', 'BranchController@index')->name('branches');
        Route::get('branch/{branch_alias}', 'BranchController@show')->name('posts.branch');

        Route::get('groups', 'GroupController@index')->name('groups');
        Route::get('group/{group}', 'GroupController@show')->name('posts.group');

        Route::get('tag/{tag_alias}', 'PostsController@tag')->name('posts.tag');

        Route::get('create/{type}', 'PostsController@create')->name('posts.create');
        Route::post('store', 'PostsController@store')->name('posts.store');
        Route::get('edit/{id}', 'PostsController@edit')->name('posts.edit');
        Route::get('attachment/{id}', 'PostsController@detachFiles')->name('posts.detach');
        Route::post('update/{id}', 'PostsController@update')->name('posts.update');
        Route::post('destroy', 'PostsController@destroy')->name('posts.destroy');

        Route::post('question/vote', 'QuestionsController@vote')->name('posts.question.vote');

        Route::get('attachments/{attachment_id}',
            'PostsController@downloadAttachment')->name('posts.download-attachment');

        Route::get('/pdf/{id}', 'PostsController@downloadPdf')->name('posts.pdf');

        Route::get('{id}/comments', 'CommentsController@post')->name('posts.comments');
        Route::post('comments', 'CommentsController@store')->name('posts.comment.store');
        Route::post('comments/{comment}', 'CommentsController@update')->name('posts.comment.update');
        Route::post('comment/delete', 'CommentsController@destroy')->name('posts.comment.delete');

        Route::get('{id}', 'PostsController@show')->name('posts.show');

        Route::post('/system_posts/{system_post}/delete', 'SystemPostController@destroy')->name('system_post.delete');
    });
