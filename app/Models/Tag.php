<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

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
