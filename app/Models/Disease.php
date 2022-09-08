<?php

namespace App\Models;

use App\Models\Crop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Disease extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'avatar',
        'diagnosis',
        'cause',
        'solution',
        'crop_id'
    ];

    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }

    public function setAvatarAttribute($avatar)
    {
        if(isset($avatar))
        {
            
            $path = $avatar;
            
            if($avatar != '')
            {
                if ($this->avatar) Storage::disk('public')->delete($this->avatar);
                if(!app()->runningInConsole()) $path = $avatar->store('crop-disease/'.date('FY'), ['disk' => 'public']);
    
            }
            
            $this->attributes['avatar'] = $path;
        }
    }    

}
