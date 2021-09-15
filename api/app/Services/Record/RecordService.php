<?php

namespace App\Services\Record;

use App\Commands\Record\Create\Command;
use App\Commands\Record\Create\Handler;
use App\Models\Record\Record;
use App\Models\User\User;
use DB;

class RecordService
{
    public function __construct()
    {}

    public function create(array $data, User $user): Record
    {
        DB::beginTransaction();
        try {
            $data['user'] = $user;

            $record = resolve(Handler::class)->handler(
                new Command($data)
            );

            DB::commit();

            return $record;
        } catch(\Exception $exception) {
            DB::rollBack();
            throw new \Exception($exception->getMessage());
        }
    }
}

