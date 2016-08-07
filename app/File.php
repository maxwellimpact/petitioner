<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class File extends Model
{
    protected $fillable = [
        'url'
    ];
    
    public function user()
    {
        $this->belongsTo(User::class);
    }
}
