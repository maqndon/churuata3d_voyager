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

    protected $translatable = ['creator_id', 'title', 'body', 'excerpt', 'slug', 'categories', 'tags', 'seo_title', 'meta_description', 'meta_keywords', 'image', 'image_gallery', 'status', 'files', 'price', 'sale_price', 'downloadable'];

    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Media::class);
    }

    public function getImageBrowseAttribute()
    {
        return $this->image ?? 'no_image.svg';
    }

    public function sales()
    {
        return $this->hasOne(Sale::class);
    }

    public function downloads()
    {
        return $this->hasOne(Download::class);
    }

    public function print_settings()
    {
        return $this->hasMany(PrintSetting::class);
    }

    public function printing_materials()
    {
        return $this->hasMany(PrintingMaterial::class);
    }

    public function print_supports_rafts()
    {
        return $this->hasOne(PrintSupportRaft::class);
    }

    public function licences()
    {
        return $this->hasOne(Licence::class);
    }

    public function bill_of_materials()
    {
        return $this->hasMany(BillOfMaterial::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

}
