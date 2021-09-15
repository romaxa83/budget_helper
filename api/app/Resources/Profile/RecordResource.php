<?php

namespace App\Resources\Profile;

use App\Models\Record\Record;
use Illuminate\Http\Resources\Json\JsonResource;

class RecordResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var Record $model */
        $model = $this->resource;

        return [
            'id' => $model->id,
            'type' => $model->type,
            'price' => $model->amount,
            'desc' => $model->desc,
            'created' => $model->created_at->diffForHumans(),
            'tags' => TagResource::collection($model->tags)
        ];
    }
}

