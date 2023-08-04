<?php

namespace App\Models;

use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use Translatable;
    use Resizable;

    protected $translatable = ['title', 'body', 'excerpt', 'slug', 'categories', 'tags', 'seo_title', 'meta_description', 'meta_keywords', 'image', 'image_gallery', 'status'];

    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Media::class);
    }

}
