<?php

namespace App\Commands\Tag\Create;

class Command
{
    public string $name;
    public string $type;
    public bool $is_base;
    public null|string $parent_id;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->type = $data['type'];
        $this->is_base = $data['is_base'] ?? false;
        $this->parent_id = $data['parent_id'] ?? null;
    }
}
