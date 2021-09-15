<?php

namespace App\Commands\Tag\Create;

use App\ValueObjects\Statuses\TypeRecord;

class Command
{
    public string $name;
    public TypeRecord $type;
    public bool $is_base;
    public null|string $parent_id;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->type = TypeRecord::create($data['type']);
        $this->is_base = $data['is_base'] ?? false;
        $this->parent_id = $data['parent_id'] ?? null;
    }
}
