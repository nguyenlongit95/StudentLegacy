<?php
/*
 * Route test demo
 * */
Route::get('/', function () {
    return view('welcome');
});

/*
 * khởi tạo ban đầu cho tài khoản
 * Khi hoàn thành sẽ xóa phần Route này đi
 * */
Auth::routes();

Route::get('role', 'HomeController@createNewRole');
Route::get('permission','HomeController@createNewPermission');
Route::get('InitFirstRole','HomeController@InitFirstRole');
Route::get('InitFirstUser','HomeController@InitFirstUser');
Route::get('AssignPermissionFirstUser','HomeController@AssignPermissionFirstUser');
/*
 * Route Login
 * */
Route::get('AdminLogin','HomeController@index');
Route::post('Login','LoginAndRegisterController@postLogin');
Route::get('logout','LoginAndRegisterController@logout');
Route::get('home',function(){
    return redirect('/');
});
/*
 * Route cho phia admin
 * */
Route::group(['prefix'=>'admin','middleware' => ['auth','role:BACKEND']],function(){
    // Trang DashBoard sẽ là nơi thống kê sản phẩm và các thông tin liên quan
    Route::get('DashBoard','adminController@DashBoard');

    /*
     * Route CURD cho cac thành phần của hệ thống
     * Categories
     * Article
     * Product
     * Blog
     * Comments
     * Contact
     * Linkeds
     * ...
     * */
    Route::group(['prefix'=>'Categories'],function(){
        Route::get('CategoriesBlog','CategoryBlogController@index');
        Route::get('addCategoriesBlog','CategoryBlogController@getStore');
        Route::post('addCategoriesBlog','CategoryBlogController@store');
        Route::get('updateCategoriesBlog/{id}','CategoryBlogController@getUpdate');
        Route::post('updateCategoriesBlog/{id}','CategoryProductController@update');
        Route::get('deleteCategoriesBlog/{id}','CategoryBlogController@destroy');

        Route::get('CategoriesProduct','CategoryProductController@index');
        Route::get('addCategoriesProduct','CategoryProductController@getStore');
        Route::post('addCategoriesProduct','CategoryProductController@store');
        Route::get('updateCategoriesProduct/{id}','CategoryProductController@getUpdate');
        Route::post('updateCategoriesProduct/{id}','CategoryProductController@update');
        Route::get('deleteCategoriesProduct/{id}','CategoryProductController@destroy');
    });

    Route::group(['prefix'=>'Product'],function(){
        Route::get('Products','ProductController@index');
        Route::get('addProducts','ProductController@getStore');
        Route::post('addProduct','ProductController@store');

        Route::get('updateProduct/{id}','ProductController@getUpdate');
        Route::post('updateProduct/{id}','ProductController@Update');

        Route::get('deleteProduct/{id}','ProductController@destroy');

        Route::post('addImage/{id}','ProductController@postAddImage');
        Route::get('deleteImage/{id}','ProductController@getDeleteImage');

        Route::post('updateCustomproperties/{id}','ProductController@updateCustomProperties');
        Route::get('deleteCustomProperties/{id}','ProductController@deleteCustomProperties');
        Route::post('addCustomProperties/{id}','ProductController@addCustomProperties');

        Route::post('addAttribute/{id}','ProductController@addAttribute');

        /*
        * More ajax Product
        */
        Route::post('getAttributeValue','ProductController@getAttributeValue');
    });

    Route::group(['prefix'=>'Ratting'],function(){
        Route::get('Sliders','RattingController@index');
        Route::get('updateRattings/{id}','RattingController@getUpdateRatting');
        Route::post('updateRattings/{id}','RattingController@update');
    });

    Route::group(['prefix'=>'Blog'],function(){
        Route::get('Blogs','BlogController@index');

        Route::get('addBlogs','BlogController@getAddBlogs');
        Route::post('addBlogs','BlogController@store');

        Route::get('updateBlog/{id}','BlogController@getUpdateBlogs');
        Route::post('updateBlogs/{id}','BlogController@update');

        Route::post('changeImageBlogs/{id}','BlogController@changeImage');
//        Route::post('changeImageBlogs/{id}',function(){
//            dd("abcabc");
//        });

        Route::get('deleteBlog/{id}','BlogController@destroy');

        Route::post('ajaxSlug','BlogController@ajaxSlug');
    });

    Route::group(['prefix'=>'Order'],function(){
        Route::get('Orders','OrderCOntroller@index');

        Route::get('updateOrder/{id}','OrderController@getUpdateOrder');
        Route::post('updateOrder/{id}','OrderCOntroller@update');

        Route::get('addOrder','OrderController@getStore');
        Route::post('addOrder','OrderController@store');

        Route::get('deleteOrder/{id}','OrderController@destroy');

        Route::get('updateOrderDetails/{id}','OrderController@getUpdateOrderDetails');

        Route::post('updateOrderDetails/{id}','OrderController@postUpdateOrderDetails');

        Route::get('deleteOrderDetails/{id}','OrderController@deleteOrderDetails');
    });

    Route::group(['prefix'=>'User'],function(){
        Route::get('Users','UserController@index');

        Route::get('updateUser/{id}','UserController@getUpdate');
        Route::post('updateUser/{ud}','UserController@update');

        Route::get('deleteUser/{id}','UserController@destroy');

        Route::post('GiveRoleUser/{id}','UserController@GiveRoleUser');
    });

    Route::group(['prefix'=>'Article'],function(){
        Route::get('Articles','ArticleController@index');
        Route::get('addArticle','ArticleController@getStore');
        Route::post('addArticle','ArticleController@store');

        Route::get('updateArticle/{id}','ArticleController@getUpdate');
        Route::post('updateArticle/{id}','ArticleController@update');

        Route::get('deleteArticle/{id}','ArticleController@destroy');
        // Ajax Title
        Route::post('createSlug','ArticleController@postAjaxSlug');
    });

    /*
     * Route cho các thành phần con trong hệ thống
     * Comments
     * Contact
     * Info of page
     * Linkeds
     * Sliders
     * API
     * */
    Route::group(['prefix'=>'Comment'],function(){
        Route::get('Comments','CommentController@index');

        Route::get('Comments/{id}','CommentController@getDetails');
        Route::get('updateComment/{id}','CommentController@getUpdate');
        Route::post('updateComment/{id}','CommentController@update');
        //Route::post('updateComment/{id}','CommentController@updateState');

        Route::get('deleteComment/{id}','CommentController@destroy');

        Route::get('addComment/{id}','CommentController@getStore');
        Route::post('addReplyComment/{id}','CommentController@adminReply');
    });

    Route::group(['prefix'=>'Contact'],function(){
        Route::get('Contacts','ContactController@index');

        Route::post('ChangeStatus/{id}','ContactController@ajaxChangeContact');

        Route::get('deleteContact','ContactController@destroy');
    });

    Route::group(['prefix'=>'Slider'],function(){
        Route::get('Sliders','SliderController@index');

        Route::get('addSlider','SliderController@getStore');
        Route::post('addSlider','SliderController@store');

        Route::get('deleteSlider/{id}','SliderController@destroy');
    });

    Route::group(['prefix'=>'InfoAndLinked'],function(){
        Route::get('index','InfoOfPageController@index');

        Route::post('updateInfoOfPage/{id}','InfoOfPageController@updateInfo');
        Route::post('updateLinked/{id}','InfoOfPageController@updateLinked');
    });

    Route::group(['prefix'=>'API'],function (){
        Route::get("APIs",'tokenAPIController@index');

        Route::get("updateAPIs",'tokenAPIController@update');
    });

    Route::group(['prefix'=>'Seo'],function(){
        Route::get('index','SeoController@index');

        Route::post('updateSeo/{id}','SeoController@update');
        Route::get('updateSeo/{id}','SeoController@show');

        Route::get('addSeo','SeoController@getStore');
        Route::post('addSeo','SeoController@store');

        Route::get('deleteSeo/{id}','SeoController@destroy');
    });

    /*
     * Route cho Widgets
     * Menu header
     * Menu footer
     * Sidebar
     * theme
     * */
    Route::group(['prefix'=>'Widgets'],function(){
        Route::get('Widgets','WidgetsController@index');
        Route::get('addWidgets','WidgetsController@create');
        Route::post('addWidgets','WidgetsController@store');
        Route::post('update/{id}','WidgetsController@update');
        Route::get('delete/{id}','WidgetsController@destroy');
    });

    Route::group(['prefix'=>'Menu'], function(){
        Route::get('menus', 'MenuController@index');
        Route::post('create','MenuController@create');
        Route::get('menus/{id}', 'MenuController@edit');
        Route::post('menus/update/{id}', 'MenuController@update');
        Route::post('changeTitle','MenuController@changeTitle');
        Route::get('menus/delete/{id}', 'MenuController@delete');
    });


    Route::group(['prefix'=>'Paygate'], function(){
        Route::get('Paygate','PaygateController@index');
        Route::get('updatePaygate/{id}','PaygateController@edit');
        Route::post('updatePaygate/{id}','PaygateController@update');
        Route::get('deletePaygate/{id}', 'PaygateController@destroy');
        Route::get('config','PaygateController@config');
    });


    Route::group(['prefix'=>'Currency'],function(){
        Route::get('Currencies','CurrencyController@index');
    });
    /*
     * Route cho Mailbox
     * Mail sends
     * Total email
     * Mail wait
     * */

    /*
     * Quản lý Role và permission
     * Thêm sửa xóa Role và permission
     * Role và permission sẽ liên kết nhiều nhiều với nhau
     * */
    Route::group(["prefix"=>"RoleAndPermission",'middleware' => ['auth','role:BACKEND']],function(){
        Route::get('RoleAndPermission','HomeController@ListRoleAndPermission');

        Route::get("addRole","HomeController@addRole");
        Route::get("addPermission","HomeController@addPermission");
        Route::post("addRole","HomeController@postAddRole");
        Route::post("addPermission","HomeController@postAddPermission");

        Route::get("updateRole/{id}","HomeController@updateRole");
        Route::get("updatePermission/{id}","HomeController@updatePermission");
        Route::post("updateRole/{id}","HomeController@postUpdateRole");
        Route::post("updatePermission/{id}","HomeController@postUpdatePermission");

        Route::get("deleteRole/{id}",'HomeController@deleteRole');
        Route::get("deletePermission/{id}",'HomeController@deletePermission');
    });


    /**
    * Route cấu hình hệ thống:
    *   Email
    *   Cổng thanh toán
    *   Các thành phần con của hệ thống
    **/
    Route::group(['prefix' => 'Email'], function () {
        Route::get('Email','EmailController@index');
        Route::get('Create','EmailController@create');
        Route::post('Create','EmailController@store');

        Route::get('Update/{id}','EmailController@edit');
        Route::post('Update/{id}','EmailController@update');

        Route::get('Delete/{id}','EmailController@delete');

        Route::get('Setting/{id}', 'EmailController@settings');

        Route::get('test','EmailController@sendMail');
    });

    /*
     * Route cho documentation
     * */
    Route::get('Documentation',function(){
        return view("Documentation");
    });
});

/*
 * Route cho phia client
 * */

Route::get('createCart','adminController@createCart');

Route::post('uploadVerificationFile','adminController@uploadVerificationFile');
Route::get('verification/{filename}','adminController@verification');
