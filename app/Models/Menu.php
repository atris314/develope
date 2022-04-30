<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['title','sort','url','post_id','status'];


    public function submenu()
    {
        return $this->hasOne(  Menu::class, 'id','post_id')->withDefault(['title'=>'---']);
    }

    public function getChid()
    {
        return $this->hasMany(Menu::class,'post_id');
    }
}
