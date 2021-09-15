<?php

namespace App\Repositories\Profile;

use App\Models\Record\Record;
use App\Repositories\AbstractRepository;

class RecordRepository extends AbstractRepository
{
    protected function modelClass(): string
    {
        return Record::class;
    }
}

