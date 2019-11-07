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
    Route::post('student-register', 'StudentController@storeStudent');
    Route::post('student-logout/{studentId}', 'StudentController@logoutStudent');

    //A02 - News feed, Post
    Route::get('news-feed-get/{idStudent}', 'PostController@getAllPost');
    Route::get('news-feed-detail-get/{idStudent}, {idPost}', 'PostController@getDetailPost');
    Route::get('news-feed-search/{idStudent}, {hashtag}', 'PostController@getPostsByHashtag');
    Route::post('post-post', 'PostController@storePost');
    Route::post('like-post', 'PostController@storeLikedPost');
    Route::post('post-rate', 'PostController@storeRate');    
    Route::post('comment-post', 'PostController@storeComment');
    Route::post('comment-reply-post', 'CommentController@storeReplyComment');

    Route::post('post-new-post', 'NewsFeedControler@storeNewPost');
    

    //A03 - Inform
    Route::post('inform-post', 'LogController@storeLog');
    Route::get('inform/{idStudent}', 'LogController@getAllLog');

    //A04 - Course
    Route::get('courses-get', 'CourseController@getAllCourse');
    Route::get('courses-search/{hashTag}', 'CourseController@getCoursesByTag');
    Route::get('course-detail-get/{idCourse}', 'CourseController@getDetailCourse');
    Route::post('schedule-update-completion', 'ScheduleController@updateCompletionSchedule');
    Route::post('schedule-update-status', 'ScheduleController@updateStatusSchedule');
    Route::get('courses-bookmark-get/{studentId}', 'StudentController@getBookmarkCourse');
    //A05 - Schedule
    Route::get('schedule/{idStudent},{time}', 'ScheduleController@getScheduleBy');
    Route::post('schedule-post', 'ScheduleController@storeNewSchedule');
    Route::get('schedule-get/{studentId}', 'ScheduleController@getScheduleByIdStudent');
    Route::post('schedule-update', 'ScheduleController@updateSchedule');
    //A06 - Setting
    Route::get('settings/{id}', 'StudentController@getInfoStudent');
    Route::get('profile-mypost-get/{idOwner},{idStudent}', 'PostController@getPostOfStudent');
    //Result statistic
    Route::get('result-statistic-get/{idStudent}', 'ResultStatisticController@getResult');

    // Blog, comment
    Route::get('detail-post/{idStudent},{idBlog}', 'BlogController@getDetailBlog');
    Route::get('student/{idStudent},{idFriend}', 'StudentController@getInfoFriend');
    Route::post('create-post','BlogController@store');
    // Route::post('like-post', 'BlogController@storeLikedBlog');
    Route::post('rate-blog', 'BlogController@storeRateBlog');

    //Post
    Route::post('post-post', 'PostController@storePost');

    //Question
    Route::post('question-post', 'QuestionController@store');
    Route::get('question-get-detail/{idStudent},{idQuestion}', 'QuestionController@getDetailQuestion');
    Route::get('question-get-all/{idStudent}', 'QuestionController@getAllQuestion');
    // Route::post('comment-post', 'NewsFeedControler@storeNewComment');
    Route::post('create-reply-comment', 'CommentController@storeReplyComment');

    //Student
    Route::get('student-friends-get/{friendsId}', 'StudentController@getFriends');
    Route::post('student-course-bookmark-post', 'StudentController@storeBookmarkCourse');
    // Subject
    Route::get('academy', 'AcademyController@getAllAcademy');

    Route::post('store','SubjectController@store');
    Route::get('show/{id}','SubjectController@show');

    Route::post('friend-request','StudentController@storeFriendRequest');
    Route::post('confirm-friend-request', 'StudentController@confirmFriendRequest');

    Route::get('test/{idSubject},{timeOrigin}', 'SubjectController@getSubjectBy');
    Route::get('test-blog/{idBlog},{idComment}', 'BlogController@storeCommentBlog');


    Route:: get('test-statistic/{dataChange}, {idStudent}, {idBranch}', 'StatisticController@saveIntoStatistic');
    Route::get('lession-get/{idLession}', 'LessionController@getLessionById');
    Route::post('test-resultdetail-post/{resultLessionId}','ResultDetailController@storeResultDetail');
    Route::post('test-resultlession-post/{scheduleId}','ResultLessionController@storeResultLession');
    
});
