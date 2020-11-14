<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    //    'middleware' => ['api', \Spatie\HttpLogger\Middlewares\HttpLogger::class],
    'prefix'     => 'api',
    'namespace'  => 'Modules\API\Http\Controllers'
], function () {
    Route::post('/login', 'Auth\AuthController@login')->name('api.login');
    Route::post('/register', 'Auth\AuthController@register');

    Route::post('/register', 'Auth\AuthController@register');

    Route::post('/password/phone', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

    Route::get('auth', 'Auth\AuthController@checkAuth');

    Route::group(['middleware' => ['auth_post', 'auth:api']], function () {
        Route::get('/lang/{locale}', ['as' => 'lang', 'uses' => 'Auth\AuthController@setLocale']);
        Route::get('users', 'ProfileController@getUser');
        Route::get('/centrifuge', 'Auth\AuthController@centrifuge');
    });

    Route::group(['middleware' => ['auth_post', 'auth:api', 'confirmed_user_api']], function () {
        Route::get('/search', 'SearchController@index');
        Route::get('/page/{alias}', 'PageController@show');

        Route::group(['prefix' => 'users'], function () {
            Route::post('/confirm/{user}', 'ProfileController@confirmUser');
            Route::get('/contacts', 'ProfileController@getUserContacts');

            Route::get('/{user}', 'ProfileController@show');
            Route::get('/{user}/posts', 'ProfileController@getUserPosts');
            Route::get('branch/access', 'ProfileController@branchAccessUser');
            Route::get('branch/{branch_alias}', 'ProfileController@branchUsers');
        });

        Route::group(['prefix' => 'settings'], function () {
            Route::post('/lang/{locale}', 'SettingsController@setLocale');
            Route::post('/account', 'SettingsController@postAccount');

            Route::get('/branches', 'SettingNotificationController@index');
            Route::post('/notifications/branch/follow', 'SettingNotificationController@branchFollow');
            Route::post('/notifications/branch/unFollow', 'SettingNotificationController@branchUnFollow');
        });

        Route::group(['prefix' => 'documents'], function () {
            Route::get('/', 'DocumentController@index');
            Route::post('/', 'DocumentController@store');

            Route::get('branch', 'DocumentController@branches');
            Route::get('branch/{branch_alias}', 'DocumentController@branch');

            Route::get('/{id}', 'DocumentController@show');
            Route::post('/{id}', 'DocumentController@update');
            Route::delete('/{id}', 'DocumentController@destroy');

            Route::get('download/{id}', 'DocumentController@getDocLink');
        });

        Route::group(['prefix' => 'financial'], function () {
            Route::get('types', 'FinancialController@getTypes');
        });

        Route::get('comment/{id}', [\Modules\API\Http\Controllers\CommentController::class, 'getComments']);

        Route::group(['prefix' => 'posts'], function () {
            Route::get('/my', 'PostController@my');

            Route::get('/', 'PostController@index');
            Route::post('/', 'PostController@store');

            Route::get('info_statuses', 'PostController@getInfoStatuses');

            Route::post('read', [\Modules\API\Http\Controllers\PostController::class, 'read']);

            Route::get('branch', 'PostController@branches');
            Route::get('branch/{branch_alias}', 'PostController@branch');

            Route::get('/premoderate', 'PostController@premoderate');

            Route::get('{id}', 'PostController@show');
            Route::post('{id}', 'PostController@update');
            Route::delete('{id}', 'PostController@destroy');

            Route::get('/{post}/history', 'PostController@history');

            Route::get('/pdf/{id}', 'PostController@getPdfLink');
            Route::get('/attachment/{id}', 'PostController@getAttachmentLink');
            Route::delete('/attachment/{id}', 'PostController@removeAttachment');

            Route::group(['prefix' => 'question'], function () {
                Route::post('vote', 'QuestionController@vote');
                Route::post('vote/action', 'QuestionController@setWinner');
            });

            Route::get('/comments/my', [\Modules\API\Http\Controllers\CommentController::class, 'my']);

            Route::get('/{post}/comments', 'CommentController@postComments');
            Route::post('/{post}/comments', 'CommentController@store');
            Route::delete('/{post}/comments/{comment}', 'CommentController@delete');
            Route::post('/{post}/comments/{comment}', 'CommentController@update');
        });

        Route::group(['prefix' => 'notifications'], function () {
            Route::get('/', 'NotificationController@getNotifications');
            Route::post('/', 'NotificationController@broadcastNotifications');
            Route::get('/not-read', 'NotificationController@notRead');
            Route::get('/unread/count', 'NotificationController@getNotReadCount');
            Route::delete('/{notification}', 'NotificationController@delete');
        });

        Route::resource('system-posts', 'SystemPostController')->only(['index', 'destroy']);

    });
});