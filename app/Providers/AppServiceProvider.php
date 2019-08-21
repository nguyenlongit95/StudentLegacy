<?php

namespace App\Providers;

use App\Repositories\Rattings\SeoRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Thêm các đường dẫn tới cho class của các Repository ở đây, ở đây là singleton để truy cập tại trang admin
        $this->app->bind(
          \App\Repositories\CategoryProducts\CategoryProductRepositoryInterface::class,
          \App\Repositories\CategoryProducts\CateoryEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\CategoryBlogs\CategoryBlogRepositoryInterface::class,
            \App\Repositories\CategoryBlogs\CateoryEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Products\ProductRepositoryInterface::class,
            \App\Repositories\Products\ProductEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\ImageProduct\ImageProductRepositoryInterface::class,
            \App\Repositories\ImageProduct\ImageProductEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Blogs\BlogRepositoryInterface::class,
            \App\Repositories\Blogs\BlogEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Rattings\RattingsRepositoryInterface::class,
            \App\Repositories\Rattings\RattingsEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Orders\OrdersRepositoryInterface::class,
            \App\Repositories\Orders\OrdersEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Users\UsersRepositoryInterface::class,
            \App\Repositories\Users\UserEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\OrdersDetails\OrderDetilasRepositoryInterface::class,
            \App\Repositories\OrdersDetails\OrderDetailsEloquentRepository::class
        );
        $this->app->bind(
          \App\Repositories\Comments\CommentRepositoryInterface::class,
          \App\Repositories\Comments\CommentEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Contact\ContactRepositoryInterface::class,
            \App\Repositories\Contact\ContactEloquentRepository::class
        );
        $this->app->bind(
                \App\Repositories\Articles\ArticleRepositoryInterface::class,
                \App\Repositories\Articles\ArticlesEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\InfoOfPage\InfoOfPageRepositoryInterface::class,
            \App\Repositories\InfoOfPage\InfoOfPageEloquentRepository::class
        );
        $this->app->bind(
          \App\Repositories\Linked\LinkedRepositoryInterface::class,
          \App\Repositories\Linked\LinkedEloquentRepository::class
        );
        $this->app->bind(
          \App\Repositories\Sliders\SliderRepositoryInterface::class,
          \App\Repositories\Sliders\SlidersEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Widgets\WidgetsRepositoryInterface::class,
            \App\Repositories\Widgets\WidgetsEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Products\CustomPropertiesRepositoryInterface::class,
            \App\Repositories\Products\CustomPropertiesEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Menus\MenuRepositoryInterface::class,
            \App\Repositories\Menus\MenuEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Seo\SeoRepositoryInterface::class,
            \App\Repositories\Seo\SeoEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Email\EmailRepositoryInterface::class,
            \App\Repositories\Email\EmailEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Email\CurrencyRepositoryInterface::class,
            \App\Repositories\Email\CUrrencyEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Email\CurrencyCodeRepositoryInterface::class,
            \App\Repositories\Email\CUrrencyCodeEloquentRepository::class
        );
        $this->app->bind(
            \App\Factory\Paygates\PaygateFactory::class
        );
    }
}
