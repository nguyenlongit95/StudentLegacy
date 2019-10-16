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
    Route::get('validate/{token}', 'StudentController@validateStudent');

    //A02 - News feed
    Route::get('news-feed/{idStudent}', 'BlogController@getAllBlog');
    Route::post('like-post', 'NewsFeedControler@storeNewLike');

    //A03 - Inform
    Route::post('inform-post', 'LogController@storeLog');
    Route::get('inform/{idStudent}', 'LogController@getAllLog');

    //A04 - Course
    Route::get('course', 'SubjectController@getAllSubject');

    //A05 - Schedule
    Route::get('schedule/{idStudent},{time}', 'ScheduleController@getScheduleBy');

    //A06 - Setting
    Route::get('settings/{id}', 'StudentController@getInfoStudent');

    // Blog, comment
    Route::get('detail-post/{idStudent},{idBlog}', 'BlogController@getDetailBlog');
    Route::get('student/{idStudent},{idFriend}', 'StudentController@getInfoFriend');
    Route::post('create-post','BlogController@store');
    // Route::post('like-post', 'BlogController@storeLikedBlog');
    Route::post('rate-blog', 'BlogController@storeRateBlog');

    //Question
    Route::post('question-post', 'QuestionController@store');
    Route::get('question-get-detail/{idStudent},{idQuestion}', 'QuestionController@getDetailQuestion');
    Route::get('question-get-all/{idStudent}', 'QuestionController@getAllQuestion');
    Route::post('create-comment', 'CommentController@storeComment');
    Route::post('create-reply-comment', 'CommentController@storeReplyComment');

    // Subject
    Route::get('academy', 'AcademyController@getAllAcademy');

    Route::post('store','SubjectController@store');
    Route::get('show/{id}','SubjectController@show');

    Route::post('friend-request','StudentController@storeFriendRequest');
    Route::post('confirm-friend-request', 'StudentController@confirmFriendRequest');

    Route::get('test/{idSubject},{timeOrigin}', 'SubjectController@getSubjectBy');
    Route::get('test-blog/{idBlog},{idComment}', 'BlogController@storeCommentBlog');


    Route:: get('test-statistic/{dataChange}, {idStudent}, {idRegion}', 'StatisticController@saveIntoStatistic');

});
