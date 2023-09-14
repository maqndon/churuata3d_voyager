<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintSupportsRaft extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'supports', 'raft'];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }


}
