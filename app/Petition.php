<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\File;
use App\Sign;
use App\User;

class Petition extends Model
{
    protected $fillable = [
        'title', 'summary', 'body', 'published', 
        'thanks_message', 'thanks_email_subject',
        'thanks_email_body'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function signs()
    {
        return $this->hasMany(Sign::class);
    }
    
    public function files()
    {
        return $this->morphToMany(File::class, 'fileable');
    }
    
    public function scopeRecentPublished($query)
    {
        return $query->orderBy('updated_at', 'desc')
                     ->where('published', 1);
    }
}
