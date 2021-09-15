<?php

namespace App\ValueObjects\Statuses;

abstract class AbstractStatus
{
    protected $value;

    // массив типов(статусов), где ключ значение, а значение перевод
    abstract public static function list(): array;

    // проверка наличие типа(статуса)
    public static function check($status): bool
    {
        return array_key_exists($status, static::list());
    }

    // проверка наличие типа(статуса), которое выкинет исключение
    public static function assert($status): void
    {
        if(!array_key_exists($status, static::list())){
            throw new \InvalidArgumentException(static::exceptionMessage(['status' => $status]));
        }
    }

    protected static function exceptionMessage(array $replace = []): string
    {
        return __('error.not valid status', $replace);
    }

    public function getValue()
    {
        return $this->value;
    }
}
