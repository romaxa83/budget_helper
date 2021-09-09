<?php

namespace Tests\Feature\Api\V1\Auth;

use App\Exceptions\Code;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\_traits\Builders\UserBuilder;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseTransactions;
    use UserBuilder;

    public function setUp(): void
    {
        parent::setUp();
        $this->passportInit();
    }

    /** @test */
    public function success()
    {
        $builder = $this->userBuilder();
        $builder->asAdmin()->create();

        $data = [
            'email' => $builder->getEmail()->getValue(),
            'password' => $builder->getPassword()
        ];

        $response = $this->post(route('api.v1.auth.login'), $data)
            ->assertOk()
            ->assertStatus(Code::OK)
        ;

        $this->assertNotEmpty($response->json('data'));
        $this->assertTrue($response->json('success'));

        $this->assertArrayHasKey('token_type', $response->json('data'));
        $this->assertArrayHasKey('expires_in', $response->json('data'));
        $this->assertArrayHasKey('access_token', $response->json('data'));
        $this->assertArrayHasKey('refresh_token', $response->json('data'));
    }

    /** @test */
    public function fail_wrong_email()
    {
        $builder = $this->userBuilder();
        $builder->asAdmin()->create();

        $data = [
            'email' => 'wrong.email@gmail.com',
            'password' => $builder->getPassword()
        ];

        $response = $this->post(route('api.v1.auth.login'), $data)
            ->assertStatus(Code::NOT_AUTH)
        ;

        $this->assertEquals(__('auth.credentials are incorrect'), $response->json('data'));
        $this->assertFalse($response->json('success'));
    }

    /** @test */
    public function fail_wrong_password()
    {
        $builder = $this->userBuilder();
        $builder->asAdmin()->create();

        $data = [
            'email' => $builder->getEmail()->getValue(),
            'password' => 'wrong'
        ];

        $response = $this->post(route('api.v1.auth.login'), $data)
            ->assertStatus(Code::NOT_AUTH)
        ;

        $this->assertEquals(__('auth.credentials are incorrect'), $response->json('data'));
        $this->assertFalse($response->json('success'));
    }

    /** @test */
    public function not_user()
    {
        $data = [
            'email' => 'not.user@gmail.com',
            'password' => 'password'
        ];

        $response = $this->post(route('api.v1.auth.login'), $data)
            ->assertStatus(Code::NOT_AUTH)
        ;

        $this->assertEquals(__('auth.credentials are incorrect'), $response->json('data'));
        $this->assertFalse($response->json('success'));
    }
}

