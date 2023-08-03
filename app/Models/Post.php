<?php

namespace App\Models;

class Post extends \TCG\Voyager\Models\Post
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
