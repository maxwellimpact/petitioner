<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
