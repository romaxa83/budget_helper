<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;

abstract class AbstractRepository
{
    const DEFAULT_LIMIT = 10;

    protected Model $model;

    public function __construct()
    {
        $this->model = app($this->modelClass());
    }

    abstract protected function modelClass(): string;

    public function getQuery(): Builder
    {
        return $this->model::query();
    }

    public function getAllQuery(array $relations = [], $sortField = 'id', $sort = 'asc'): Builder
    {
        return $this->getQuery()->with($relations)->orderBy($sortField, $sort);
    }

    public function getAll(array $relations = [], $sortField = 'id', $sort = 'asc'): Collection
    {
        return $this->getAllQuery($relations, $sortField, $sort)->get();
    }

    public function getAllBy(
        string $field,
        string $value,
        array $relations = [],
        $sortField = 'id',
        $sort = 'asc'
    ): Collection
    {
        return $this->getQuery()
            ->where($field, $value)
            ->with($relations)
            ->orderBy($sortField, $sort)
            ->get();
    }

    public function getAllPaginator(array $params, array $relations = [], $sortField = 'id', $sort = 'asc'): LengthAwarePaginator
    {
        $perPage = $params['perPage'] ?? self::DEFAULT_LIMIT;

        return $this->getAllQuery($relations, $sortField, $sort)->paginate($perPage);
    }

    public function getAllWithCount(array $relations = []): Collection
    {
        return $this->getQuery()->withCount($relations)->get();
    }

    public function getForSelect($field, array $relations = []): array
    {
        return $this->getAllQuery($relations)->pluck($field, 'id')->toArray();
    }

    /*
     *  Get one model
     */

    public function getOneQuery(
        string $field,
        string $value,
        array $relations = []
    ): Builder
    {
        return $this->getQuery()
            ->with($relations)
            ->where($field, $value);
    }

    public function getOneBy(
        string $field,
        string $value,
        array $relations = []
    ): ?Model
    {
        return $this->getOneQuery($field, $value, $relations)->first();
    }

    public function findOneBy(
        string $field,
        string $value,
        array $relations = []
    ): Model
    {
        if($model = $this->getOneBy($field, $value, $relations)){
            return $model;
        }

        throw new \DomainException("Not found model", Response::HTTP_NOT_FOUND);
    }
}
