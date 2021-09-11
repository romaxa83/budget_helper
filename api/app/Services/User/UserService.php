<?php

namespace App\Services\User;

use App\Commands\User;
use App\Models\User\User as UserModel;
use App\Repositories\Profile\TagRepository;
use DB;

class UserService
{
    public function __construct(protected TagRepository $tagRepository)
    {}

    public function signup(array $data): UserModel
    {
        DB::beginTransaction();
        try {
            $user = resolve(User\SignUp\Handler::class)->handler(
                new User\SignUp\Command($data)
            );

            $tags = $this->tagRepository->getAllBy('is_base', true)
                ->pluck('id')->toArray();

            $user = resolve(User\AttachTags\Handler::class)->handler(
                new User\AttachTags\Command($tags),
                $user
            );

            DB::commit();

            return $user;
        } catch(\Exception $exception) {
            DB::rollBack();
            throw new \Exception($exception->getMessage());
        }
    }
}

