<?php

namespace App\Repositories\User;

use App\Models\User\User;
use App\Repositories\AbstractRepository;

class UserRepository extends AbstractRepository
{
    protected function modelClass(): string
    {
        return User::class;
    }
}
