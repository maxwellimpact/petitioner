<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use App\File;
use App\Petition;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function petitions()
    {
        return $this->hasMany(Petition::class);
    }
    
    public function files()
    {
        return $this->hasMany(File::class);
    }
}
