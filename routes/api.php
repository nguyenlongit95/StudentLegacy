<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Build route APIs demo

Route::post('login','UserController@login');
Route::post('register','UserController@register');
Route::group(['middleware'=>'auth:api'], function(){
    Route::post('details','UserController@details');
});

Route::group(['prefix'=>'v1'], function () {
    //A01 - Login
    Route::post('login','StudentController@loginStudent');
    Route::post('updateStudent/{id}','StudentController@update');

    //A02 - News feed
    Route::get('news-feed/{idStudent}', 'BlogController@getAllBlog');

    //A03 - Inform

    //A04 - Course
    Route::get('course', 'SubjectController@getAllSubject');

    //A05 - Schedule

    //A06 - Setting
    Route::get('settings/{id}', 'StudentController@getInfoStudent');

    // Blog, comment
    Route::get('detail-post/{idStudent},{idBlog}', 'BlogController@getDetailBlog');
    Route::get('student/{idStudent},{idFriend}', 'StudentController@getInfoFriend');
    Route::post('create-post','BlogController@store');
    Route::post('like-post', 'BlogController@storeLikedBlog');

    Route::post('create-comment', 'CommentController@storeComment');
    Route::post('create-reply-comment', 'CommentController@storeReplyComment');

    // Subject
    Route::get('academy', 'AcademyController@getAllAcademy');

    

    Route::post('store','SubjectController@store');
    Route::get('show/{id}','SubjectController@show');

    Route::post('friend-request','StudentController@storeFriendRequest');
    Route::post('confirm-friend-request', 'StudentController@confirmFriendRequest');
    
});
