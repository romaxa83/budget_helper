<?php

namespace App\Commands\Tag\Create;

use App\Models\Tag\Tag;

class Handler
{
    public function __construct()
    {}

    public function handler(Command $command): Tag
    {
        $model = new Tag();
        $model->name = $command->name;
        $model->type = $command->type;
        $model->is_base = $command->is_base;
        $model->parent_id = $command->parent_id;

        $model->save();

        return $model;
    }
}
