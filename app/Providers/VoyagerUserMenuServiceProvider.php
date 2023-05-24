<?php

namespace App\Providers;

use TCG\Voyager\Models\Menu;
use Illuminate\Support\ServiceProvider;

class VoyagerUserMenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $menuName = 'users';

        // check if a "users" menu already exist
        $menu = Menu::where('name', $menuName)->first();

        // Create a new menu
        if (!$menu) {
            $menu = new Menu();
            $menu->name = $menuName;
            $menu->save();
        }
    }
}
