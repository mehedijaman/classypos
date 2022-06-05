<?php

namespace ClassyPOS\Policies;

use ClassyPOS\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
