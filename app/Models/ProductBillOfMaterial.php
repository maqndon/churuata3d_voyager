<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBillOfMaterial extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'items'];

    public function products()
    {
        return $this->belongsTo(Product::class)
            ->published()
            ->orderBy('created_at', 'DESC');
    }
}
