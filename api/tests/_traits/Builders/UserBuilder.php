<?php

namespace Tests\_traits\Builders;

trait UserBuilder
{
    public function userBuilder()
    {
        return new \Tests\_helpers\Builders\UserBuilder();
    }
}
