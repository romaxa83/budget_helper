<?php

namespace App\Resources\Profile;

use App\Models\Tag\Tag;
use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var Tag $model */
        $model = $this->resource;

        return [
            'id' => $model->id,
            'name' => $model->name,
            'type' => $model->type,
            'is_base' => $model->is_base,
            $this->mergeWhen($model->childrenTags->isNotEmpty(), [
                'children' => TagResource::collection($model->childrenTags)
            ]),
        ];
    }
}
