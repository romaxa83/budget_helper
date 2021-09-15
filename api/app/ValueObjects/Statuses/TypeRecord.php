<?php

namespace App\ValueObjects\Statuses;

final class TypeRecord extends AbstractStatus
{
    const COMING = 'coming';
    const EXPENSES = 'expenses';

    public static function list(): array
    {
        return [
            self::COMING => __('translation.type.record.coming'),
            self::EXPENSES => __('translation.type.record.expenses'),
        ];
    }

    public static function create($value): self
    {
        static::assert($value);

        $self = new self();
        $self->value = $value;

        return $self;
    }

    public function isComing(): bool
    {
        return $this->value == self::COMING;
    }

    public function isExpenses(): bool
    {
        return $this->value === self::EXPENSES;
    }
}
