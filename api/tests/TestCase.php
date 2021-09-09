<?php

namespace Tests;

use App\Models\User\User;
use App\Repositories\Passport\PassportClientRepository;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function passportInit(): void
    {
        $this->artisan("passport:client --password --provider=users --name='Users'");

        $userPassportClient = $this->getPassportRepository()->findForUser();
        \Config::set('auth.oauth_client.users.id', $userPassportClient->id);
        \Config::set('auth.oauth_client.users.secret', $userPassportClient->secret);
    }

    protected function getPassportRepository(): PassportClientRepository
    {
        return resolve(PassportClientRepository::class);
    }

    protected function loginAsUser(User $user = null): User
    {
        if (!$user) {
            $user = User::factory()->create();
        }

        $this->actingAs($user);

        return $user;
    }
}
