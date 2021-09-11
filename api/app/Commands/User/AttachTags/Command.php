<?php

namespace App\Commands\User\AttachTags;

class Command
{
    public array $tags = [];

    public function __construct($data)
    {
        if(is_array($data)) {
            $this->tags = $data;
        } else {
            $this->tags[] = $data;
        }
    }
}

