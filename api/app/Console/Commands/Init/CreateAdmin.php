<?php

namespace App\Console\Commands\Init;

use App\Models\User\User;
use App\Repositories\User\UserRepository;
use App\ValueObjects\Statuses\UserStatus;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    protected $signature = 'cmd:create-admin';

    protected $description = 'Create super admin';

    /**
     * @param UserRepository $userRepository
     */
    public function handle(UserRepository $userRepository)
    {
        $email = 'admin@admin.com';
        $password = 'password';

        if($userRepository->getOneBy('email', $email)){
            $this->warn("admin exist");
        } else {

            $admin = new User();
            $admin->name = 'admin';
            $admin->email = $email;
            $admin->password = Hash::make($password);
            $admin->status = UserStatus::ACTIVE;
            $admin->role = User::ROLE_ADMIN;
            $admin->save();

            $this->info("super admin created");
        }

        $this->info("[✔] - email: {$email}");
        $this->info("[✔] - password: {$password}");
        $this->info("-------------------");
    }
}
