<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintSupportsRaft extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'supports', 'raft'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


}
