<?php

namespace App\Commands\User\SignUp;

use App\Models\User\User;

class Command
{
    public $name;
    public $email;
    public $phone;
    public $password;
    public $role;

    public function __construct(array $data)
    {
        $this->name = $data['name'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->phone = $data['phone'] ?? null;
        $this->password = $data['password'] ?? null;
        $this->role = $data['role'] ?? User::ROLE_USER;
    }
}
