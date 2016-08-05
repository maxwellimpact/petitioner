<?php

namespace App\Policies;

use App\User;
use App\Petition;
use Illuminate\Auth\Access\HandlesAuthorization;

class PetitionPolicy
{
    //use HandlesAuthorization;
    
    public function view(User $user, Petition $petition)
    {
        return $user->id == $petition->user->id;
    }
    
}
