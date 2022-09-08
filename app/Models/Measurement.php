<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Measurement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ph',
        'ec',
        'temp',
        'humidity',
        'soil_moisture',
        'crop_id'
    ];

    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }
}
