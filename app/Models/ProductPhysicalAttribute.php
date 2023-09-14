<?php

namespace App\Models;

use TCG\Voyager\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductPhysicalAttribute extends Model
{
    use HasFactory;
    use Translatable;

    protected $fillable = ['product_id', 'weight', 'length', 'width', 'height'];

    protected $translatable = ['weight', 'length', 'width', 'height'];

    protected $guarded = [];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}