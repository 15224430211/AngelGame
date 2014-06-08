<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

Route::get('/', 'SiteIndexController@getIndex');
Route::controller('index', 'SiteIndexController');
Route::get('logout', 'SiteIndexController@getLogout');
Route::group(array('before' => 'islogin'), function () {
    Route::get('user/{uid?}', 'SiteUserController@getIndex');
    Route::get('user/{uid}/{status}', 'SiteUserController@getGameList');
    Route::post('user-game-relation', 'SiteUserController@ajaxUserGameRelation');
    Route::get('search/{q?}', 'SiteSearchController@getIndex');
    Route::get('game/{game?}', 'SiteGameController@getIndex');
    Route::post('game', 'SiteGameController@postIndex');
    Route::controller('setting', 'SiteSettingController');
    Route::get('follow/{uid?}', 'SiteFriendController@getFollow');
    Route::post('follow', 'SiteFriendController@postFollow');
    Route::get('fans/{uid?}', 'SiteFriendController@getFans');
    Route::controller('tweet', 'SiteTweetController');
//    Route::post('fans', 'SiteFriendController@postFans');
});
