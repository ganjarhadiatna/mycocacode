<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/image/all', 'MainController@imageAll');
Route::get('*', function () {
    return view('404', [
        'title' => '404 Not Found',
        'path' => 'none'
    ]);
});

//design
Route::get('/', 'MainController@index');
Route::get('/designs', 'MainController@index');
Route::get('/home', 'MainController@index');
Route::get('/make-apps', 'MainController@makeApps');
Route::get('/tags/{ctr}', 'MainController@tagsId');
Route::get('/category/{ctr}', 'MainController@ctrId');
Route::get('/categories', 'MainController@ctr');
Route::get('/popular', 'MainController@popular');
Route::get('/fresh', 'MainController@fresh');
Route::get('/trending', 'MainController@trending');
Route::get('/search/{ctr}', 'MainController@search');
Route::get('/search', 'MainController@searchNormal');
Route::get('/story/{id}', 'StoryController@story')->where(['id' => '[0-9]+']);
Route::get('/story/{id}/{title}', 'StoryController@story')->where(['id' => '[0-9]+']);
Route::get('/s/{id}', 'StoryController@story')->where(['id' => '[0-9]+']);
Route::get('/image/{idimage}', 'ImageController@detail')->where(['idimage' => '[0-9]+']);

//news
Route::get('/news', 'NewsController@index');
Route::get('/news/fresh', 'NewsController@freh');
Route::get('/news/trending', 'NewsController@trending');
Route::get('/news/popular', 'NewsController@popular');

//lives
Route::get('/lives', 'LiveController@index');
Route::get('/lives/fresh', 'LiveController@freh');
Route::get('/lives/trending', 'LiveController@trending');
Route::get('/lives/popular', 'LiveController@popular');

/*user*/
Route::get('/user/{iduser}', 'ProfileController@story')->where(['iduser' => '[0-9]+']);
Route::get('/u/{iduser}', 'ProfileController@story')->where(['iduser' => '[0-9]+']);

/*story*/
Route::get('/story/all', 'StoryController@allStory');

/*loves*/
Route::post('/loves/add', 'StoryController@addLoves');

/*comment*/
Route::get('/get/comment/{idstory}/{offset}/{limit}', 'CommentController@get')->where(['idstory' => '[0-9]+']);

Auth::routes();

Route::middleware('auth')->group(function() {
    /*user*/
    Route::get('/user/{iduser}/following', 'FollowController@following')->where(['iduser' => '[0-9]+']);
    Route::get('/user/{iduser}/followers', 'FollowController@followers')->where(['iduser' => '[0-9]+']);
    Route::get('/user/{iduser}/story', 'ProfileController@story')->where(['iduser' => '[0-9]+']);
    Route::get('/user/{iduser}/save', 'ProfileController@save')->where(['iduser' => '[0-9]+']);

	/*profile*/
	Route::get('/me', 'ProfileController@profile');
    Route::get('/me/setting', 'ProfileController@profileSetting');
    
    Route::get('/me/setting/profile', 'ProfileController@profileSettingProfile');

    Route::get('/me/setting/info/public', 'ProfileController@profileSettingInfoPublic');
    Route::get('/me/setting/info/private', 'ProfileController@profileSettingInfoPrivate');

    Route::get('/me/setting/password', 'ProfileController@profileSettingPassword');

    //notifications
    Route::get('/notifications', 'NotifController@notifications');

    //saved
    Route::get('/saved', 'ProfileController@save');

    //design
    Route::get('/timelines', 'MainController@timelines');

    //news
    Route::get('/news/timelines', 'NewsController@timelines');

    //lives
    Route::get('/lives/timelines', 'LiveController@timelines');

    Route::post('/save/publicInformations', 'ProfileController@savePublicInformations');
    Route::post('/save/privateInformations', 'ProfileController@savePrivateInformations');
    Route::post('/save/profilePicture', 'ProfileController@saveProfilePicture');
    Route::post('/save/password', 'ProfileController@savePassword');

    /*compose*/
    Route::get('/compose', 'MainController@composeStory');
    Route::get('/compose/story', 'MainController@composeStory');
    Route::post('/story/image/upload', 'ImageController@upload');
    Route::post('/story/publish', 'StoryController@publish');
    Route::get('/story/{idstory}/edit/{iduser}/{token}', 'StoryController@storyEdit');
    Route::post('/story/save/editting', 'StoryController@saveEditting');
    Route::post('/story/delete', 'StoryController@deleteStory');

    /*Follow*/
    Route::post('/follow/add', 'FollowController@add');
    Route::post('/follow/remove', 'FollowController@remove');

    /*bookmark*/
    Route::post('/add/bookmark', 'BookmarkController@add');
    Route::post('/remove/bookmark', 'BookmarkController@remove');

    /*love*/
    Route::post('/add/love', 'LoveController@add');
    Route::post('/remove/love', 'LoveController@remove');

    /*comment*/
    Route::post('/add/comment', 'CommentController@add');
    Route::post('/delete/comment', 'CommentController@delete');

    /*notifications*/
    Route::post('/notif/story', 'NotifController@notifStory');
    Route::post('/notif/following', 'NotifController@notifFollowing');
    Route::get('/notif/cek', 'NotifController@notifCek');
    Route::get('/notif/cek/story', 'NotifController@notifCekStory');
    Route::get('/notif/cek/following', 'NotifController@notifCekFollowing');

    /*get notif*/
    Route::get('/get/notif/story', 'NotifController@getNotifStory');
});