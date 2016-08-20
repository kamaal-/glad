<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User as User;
use App\Models\Image as Image;

class Collage extends Model
{

    protected $fillable = ['name', 'user_id'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function images()
    {
      return $this->hasMany(Image::class);
    }
}
