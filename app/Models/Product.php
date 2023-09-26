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
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
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

    public function product_downloads()
    {
        return $this->hasOne(ProductDownload::class);
    }

    public function print_settings()
    {
        return $this->belongsToMany(PrintSetting::class, 'product_print_settings');
    }

    public function printing_materials()
    {
        return $this->hasMany(PrintingMaterial::class);
    }

    public function print_supports_rafts()
    {
        return $this->hasOne(PrintSupportRaft::class);
    }

    public function licence()
    {
        return $this->belongsToMany(Licence::class, 'product_licence');
    }

    public function bill_of_materials()
    {
        return $this->hasMany(ProductBillOfMaterial::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
