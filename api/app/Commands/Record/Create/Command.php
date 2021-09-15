<?php

namespace App\Commands\Record\Create;

use App\Models\User\User;
use App\ValueObjects\Statuses\TypeRecord;
use Carbon\Carbon;

class Command
{
    public User $user;
    public TypeRecord $type;
    public float $amount;
    public array $tags = [];
    public null|string $desc;
    public $created_at;

    public function __construct(array $data)
    {
        $this->user = $data['user'];
        $this->type = TypeRecord::create($data['type']);
        $this->amount = $data['amount'];
        $this->tags = $data['tags'];
        $this->desc = $data['desc'] ?? null;
        $this->created_at = $data['created'] ?? null;
    }
}

