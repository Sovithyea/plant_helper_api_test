<?php

namespace App\Models;

use App\Models\Guide;
use App\Models\Measurement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Disease;

class Crop extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'sown',
        'harvest',
        'expired',
        'avatar'
    ];

    
    public function measurement()
    {
        return $this->hasOne(Measurement::class)->withDefault([
            'ec' => 'N/A',
            'ph' => 'N/A',
            'humidity' => 'N/A',
            'soil_moisture' => 'N/A',
            'temp' => 'N/A'
        ]);
    }

    public function disease()
    {
        return $this->hasMany(Disease::class);
    }

    public function setAvatarAttribute($avatar)
    {
        if(isset($avatar))
        {
            $path = $avatar;
            
            if($avatar != '')
            {
                if ($this->avatar) Storage::disk('public')->delete($this->avatar);
                if(!app()->runningInConsole()) $path = $avatar->store('crop/'.date('FY'), ['disk' => 'public']);
    
            }

            $this->attributes['avatar'] = $path;
        }
    }    


    public function guide()
    {
        $this->belongsToMany(Guide::class);
    }
}
