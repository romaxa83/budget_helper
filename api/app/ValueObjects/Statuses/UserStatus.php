<?php

namespace App\ValueObjects\Statuses;

final class UserStatus extends AbstractStatus
{
    const DRAFT  = 1;
    const ACTIVE = 2;
    const BAN    = 3;

    public static function list(): array
    {
        return [
            self::DRAFT => __('translation.user.status.draft'),
            self::ACTIVE => __('translation.user.status.active'),
            self::BAN => __('translation.user.status.ban'),
        ];
    }

    public static function create($value): self
    {
        static::assert($value);

        $self = new self();
        $self->value = $value;

        return $self;
    }

    public function isActive(): bool
    {
        return $this->value == self::ACTIVE;
    }

    public function isDraft(): bool
    {
        return $this->value === self::DRAFT;
    }

    public function isBan(): bool
    {
        return $this->value === self::BAN;
    }
}


