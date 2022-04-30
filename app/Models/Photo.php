<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $uploads = '/images/';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function portfolios()
    {
        return $this->belongsToMany(Portfolio::class);
    }


    public function getPathAttribute($photo)
    {
        return $this->uploads . $photo;
    }
}
