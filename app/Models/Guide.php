<?php

namespace App\Models;

use App\Models\Crop;
use App\Models\Type;
use App\Models\Stage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guide extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'avatar',
        'value',
        'schedule',
        'description',
        'stage_id',
        'type_id'
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function crop()
    {
        return $this->belongsToMany(Crop::class);
    }
}
