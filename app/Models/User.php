<?php

namespace App\Models;

use App\Models\PurchasedPresent;
use App\Notifications\MailResetPasswordToken;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordToken($token));
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }


    public function isAdmin()
    {
        foreach ($this->roles()->get() as $role){
//            if ($role->name == 'مدیر' && $this->status == 1){
//                return true;
//            }
            if ( $this->status == 1){
                return true;
            }
        }
        return false;
    }

    public function isRole()
    {
        foreach ($this->roles()->get() as $role){
            if($role->name == 'پشتیبان' && $this->status == 1){
                return true;
            }
        }
    }
    public function isClient()
    {
        foreach ($this->roles()->get() as $role){
            if ($role->name == 'کاربر عادی'){
                return true;
            }
        }
        return false;
    }

//    public function isMobile()
//    {
//        foreach ($this->user as $user){
//            if ($user->mobile){
//                return true;
//            }
//        }
//        return false;
//    }
}
