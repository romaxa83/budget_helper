<?php

namespace App\Repositories\Passport;

use Illuminate\Database\Eloquent\Builder;
use Laravel\Passport\Client;

class PassportClientRepository
{
    public function findFor(string $provider): ?Client
    {
        return $this->query()
            ->where('provider', $provider)
            ->where('password_client', 1)
            ->where('revoked', 0)
            ->first();
    }

    public function query(): Builder|Client
    {
        return Client::query();
    }

    public function findForUser(): ?Client
    {
        return $this->findFor('users');
    }
}
