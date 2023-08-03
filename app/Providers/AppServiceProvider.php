<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Product;
use App\Models\Category;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Voyager::useModel('Product', Product::class);
        Voyager::useModel('Category', Category::class);
        Voyager::useModel('Category', Post::class);
    }
}
