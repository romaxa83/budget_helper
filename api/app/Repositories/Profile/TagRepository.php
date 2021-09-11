<?php

namespace App\Repositories\Profile;

use App\Models\Tag\Tag;
use App\Repositories\AbstractRepository;

class TagRepository extends AbstractRepository
{
    protected function modelClass(): string
    {
        return Tag::class;
    }

    public function getAllWithParams(array $params, array $relations = [], $sortField = 'id', $sort = 'asc')
    {
        $perPage = $params['perPage'] ?? $this->limit();
        $list = array_key_exists('list', $params) ? true : false;
        $parent = array_key_exists('parent', $params) ? true : false;

        $query = $this->getAllQuery($relations, $sortField, $sort);

        if($parent){
            $query
                ->where('parent_id', null);
        }
        if($list){
            return $query->get();
        }
        return $query->paginate($perPage);
    }
}
