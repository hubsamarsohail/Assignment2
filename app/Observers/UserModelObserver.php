<?php

namespace App\Observers;

use App\User;
use Illuminate\Support;
use Illuminate\Support\Str;
class UserModelObserver
{
    //
    public function creating(User $user)
    {
        $user->uid = Str::uuid();
    }
}
