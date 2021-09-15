<?php

namespace App\Commands\Record\Create;

use App\Models\Record\Record;
use Carbon\Carbon;

class Handler
{
    public function __construct()
    {}

    public function handler(Command $command): Record
    {
        $model = new Record();
        $model->user_id = $command->user->id;
        $model->type = $command->type->getValue();
        $model->amount = $command->amount;
        $model->desc = $command->desc;
        $model->created_at = $command->created_at ?? Carbon::now();

        $model->save();

        $model->tags()->attach($command->tags);

        return $model;
    }
}
