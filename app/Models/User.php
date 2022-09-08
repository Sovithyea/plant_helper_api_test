<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'first_name',
        'last_name',
        'username',
        'phone_number',
        'email',
        'password',
        'role',
        'gender'
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setAvatarAttribute($avatar)
    {
        if(isset($avatar))
        {
            $path = $avatar;
            
            if($avatar != '')
            {
                if ($this->avatar) Storage::disk('public')->delete($this->avatar);
                if(!app()->runningInConsole()) $path = $avatar->store('user/'.date('FY'), ['disk' => 'public']);
            }
            
            $this->attributes['avatar'] = $path;
        }
    }
}
