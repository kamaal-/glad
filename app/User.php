<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Collage as Collage;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'picture', 'picture_original'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function collages()
    {
      return $this->hasMany(Collage::class);
    }

}
