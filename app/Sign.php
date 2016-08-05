<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Petition;

class Sign extends Model
{
    protected $fillable = [
        'name', 'email', 'phone'
    ];
    
    public function petition()
    {
        return $this->belongsTo(Petition::class);
    }
}
