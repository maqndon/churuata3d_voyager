<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintingMaterial extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'nozzle_size', 'min_hot_bed_temp', 'max_hot_bed_temp'];

    public function product()
    {
        return $this->belongsToMany(PrintSetting::class)
            ->published()
            ->orderBy('created_at', 'DESC');
    }
}

