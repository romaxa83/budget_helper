<?php

namespace App\Resources\User;

use App\Models\User\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var User $model */
        $model = $this->resource;

        return [
            'id' => $model->id,
            'name' => $model->name,
            'email' => $model->email->getValue(),
            'role' => $model->role,
            'phone' => $model->phone,
            $this->mergeWhen($model->isUser(), [
                'total_expenses' => $model->totalExpenses,
                'total_coming' => $model->totalComing,
            ]),
        ];
    }
}
