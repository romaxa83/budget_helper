<?php

namespace App\Commands\User\SignUp;

use App\Models\User\User;
use App\Repositories\Profile\TagRepository;
use App\ValueObjects\Email;
use App\ValueObjects\Phone;
use Illuminate\Support\Facades\Hash;

class Handler
{
    public function __construct(protected TagRepository $tagRepository)
    {}

    public function handler(Command $command): User
    {
        $model = new User();
        $model->name = $command->name;
        $model->email = new Email($command->email);
        $model->password = Hash::make($command->password);
        $model->role = $command->role;
        $model->phone = $command->phone ? new Phone($command->phone) : null;
        $model->save();


        return $model;
    }
}
