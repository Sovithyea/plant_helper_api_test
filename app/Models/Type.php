<?php

namespace App\Models;

use App\Models\Guide;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function guide()
    {
        $this->hasMany(Guide::class);
    }
}
