<?php

namespace App\Models;

use App\Models\Product;

class Category extends \TCG\Voyager\Models\Category
{

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->published()
            ->orderBy('created_at', 'DESC');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class)
            ->published()
            ->orderBy('created_at', 'DESC');
    }

}
