<?php

namespace App\Commands\User\AttachTags;

use App\Models\User\User;

class Handler
{
    public function __construct()
    {}

    public function handler(Command $command, User $user): User
    {
        $user->tags()->attach($command->tags);

        return $user;
    }
}
