<?php

namespace Tests\_helpers\Builders;

use App\Models\User\User;
use App\ValueObjects\Email;
use App\ValueObjects\Phone;
use App\ValueObjects\Statuses\UserStatus;

class UserBuilder
{
    private string $name = 'test user';
    private string|null $email = 'test@user.com';
    private string $password = 'password';
    private string $phone = '+3809912343567';
    private bool $phoneVerify = false;
    private $role = User::ROLE_USER;
    private $status = UserStatus::ACTIVE;

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    public function getEmail()
    {
        return null != $this->email ? new Email($this->email) : null;
    }

    public function getPhone()
    {
        return new Phone($this->phone);
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function phoneVerify(): self
    {
        $this->phoneVerify = true;

        return $this;
    }

    public function asAdmin(): self
    {
        $this->role = User::ROLE_ADMIN;
        return $this;
    }

    public function create()
    {
        $user = $this->save();

        return $user;
    }

    private function save()
    {
        $data = [
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'phone' => $this->getPhone(),
            'phone_verify' => $this->phoneVerify,
            'password' => \Hash::make($this->password),
            'status' => $this->getStatus(),
            'role' => $this->getRole(),
        ];

        return User::factory()->new($data)->create();
    }
}


