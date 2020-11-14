<?php

use Illuminate\Support\Facades\Auth;

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Users\Http\Controllers'], function () {
    Auth::routes();

    Route::get('/', 'HomeController@index');

    Route::get('/notifications/cron', 'HomeController@cron');

    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('/confirm', 'HomeController@confirmPage')->middleware('auth')->name('confirm');

    Route::group(['middleware' => ['auth', 'confirmed_user']], function () {
        Route::get('/profile/{id?}', 'UsersController@show')->name('profile');

        Route::get('/home', 'HomeController@home')->name('home');
        Route::get('/account', 'HomeController@getHomePage')->name('account');
        Route::post('/account', 'HomeController@postUpdateUser')->name('account.post');

        Route::get('/settings/notifications', 'SettingNotificationController@index')->name('setting.notifications');
        Route::post('/settings/notifications/branch/follow',
            'SettingNotificationController@branchFollow')->name('settings.notifications.branch.follow');
        Route::post('/settings/notifications/branch/unfollow',
            'SettingNotificationController@branchUnfollow')->name('settings.notifications.branch.unfollow');

        Route::get('/users', 'UsersController@index')->name('users');

        Route::get('/notifications', 'NotificationController@index')->name('user.notifications');
        Route::post('/notifications', 'NotificationController@getNotifications');

        Route::get('/notifications/not-read', 'NotificationController@notRead')->name('user.notifications.not-read');
    });

    Route::get('/lang/{locale}', [
        'as'   => 'lang',
        'uses' => 'UsersController@setLocale',
    ]);
});