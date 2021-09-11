<?php

namespace App\Services\Tag;

use App\Commands\Tag\Create\Command;
use App\Commands\Tag\Create\Handler;
use App\Models\Tag\Tag;
use App\Models\User\User;
use App\Commands\User as UserCommand;
use DB;

class TagService
{
    public function __construct()
    {}

    public function create(array $data, User $user): Tag
    {
        DB::beginTransaction();
        try {
            $data['is_base'] = $user->isAdmin() ? true : false;

            $tag = resolve(Handler::class)->handler(
                new Command($data)
            );

            if(!$data['is_base']){
                resolve(UserCommand\AttachTags\Handler::class)->handler(
                    new UserCommand\AttachTags\Command($tag->id),
                    $user
                );
            }

            DB::commit();

            return $tag;
        } catch(\Exception $exception) {
            DB::rollBack();
            throw new \Exception($exception->getMessage());
        }
    }
}
