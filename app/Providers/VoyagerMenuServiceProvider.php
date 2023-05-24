<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;

class VoyagerMenuServiceProvider extends ServiceProvider
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
        // Register your custom menu entries
        $this->registerCustomMenuEntries();
    }

    private function registerCustomMenuEntries()
    {

        $menuItems = [

            [
                'title' => 'Products',
                'url' => '',
                'route' => 'voyager.products.index',
                'target' => '_self',
                'icon_class' => 'voyager-archive',
                'color' => null,
                'parent_id' => null,
                'order' => 7,
            ],

            [
                'title' => 'Pages',
                'url' => '',
                'route' => 'voyager.pages.index',
                'target' => '_self',
                'icon_class' => 'voyager-documentation',
                'color' => null,
                'parent_id' => null,
                'order' => 4,
            ],

            [
                'title' => 'Posts',
                'url' => '',
                'route' => 'voyager.posts.index',
                'target' => '_self',
                'icon_class' => 'voyager-file-text',
                'color' => null,
                'parent_id' => null,
                'order' => 6,
            ],

        ];

        // Get all menus
        $menus = Menu::all();

        foreach ($menus as $menu) {
            foreach ($menuItems as $item) {
                $existingMenuItem = MenuItem::where('menu_id', $menu->id)->where('title', $item['title'])->first();

                if (!$existingMenuItem) {
                    $menuItem = new MenuItem();
                    $menuItem->menu_id = $menu->id;
                    $menuItem->fill($item);
                    $menuItem->save();
                }
            }
        }
    }
}
