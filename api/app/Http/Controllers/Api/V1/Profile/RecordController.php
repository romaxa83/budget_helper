<?php

namespace App\Http\Controllers\Api\V1\Profile;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Profile\Record\Create;
use App\Models\User\User;
use App\Repositories\Profile\RecordRepository;
use App\Resources\Profile\RecordResource;
use App\Resources\Profile\TagResource;
use App\Services\Record\RecordService;
use Illuminate\Http\Request;

class RecordController extends ApiController
{
    public function __construct(
        protected RecordRepository $repository,
        protected RecordService $service
    )
    {}

    public function index(Request $request)
    {
        try {
            return RecordResource::collection(
                $this->repository->getAllWithParams($request->all())
            );
        } catch (\Exception $e){
            return $this->errorJsonMessage($e->getMessage(), $e->getCode());
        }
    }

    public function show(Request $request, $id)
    {
        try {
            return RecordResource::make($this->repository->getOneBy('id', $id));
        } catch (\Exception $e){
            return $this->errorJsonMessage($e->getMessage(), $e->getCode());
        }
    }

    public function create(Create $request)
    {
        try {
            /** @var $user User */
            $user = \Auth::user();

            return RecordResource::make(
                $this->service->create($request->all(), $user)
            );
        } catch (\Exception $e){
            return $this->errorJsonMessage($e->getMessage(), $e->getCode());
        }
    }
}

