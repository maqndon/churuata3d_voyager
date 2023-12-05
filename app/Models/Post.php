<?php

namespace App\Models;

class Post extends \TCG\Voyager\Models\Post
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

    public function getImageBrowseAttribute()
    {
        return $this->image ?? 'no_image.svg';
    }

    public function product_seo()
    {
        return $this->hasOne(PostSeo::class);
    }
}
