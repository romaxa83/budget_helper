<?php

namespace App\Http\Controllers\Api\V1\Profile;

use App\Commands\Tag\Create\Command;
use App\Commands\Tag\Create\Handler;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Profile\Tag\Create;
use App\Models\Tag\Tag;
use App\Models\User\User;
use App\Repositories\Profile\TagRepository;
use App\Resources\Profile\TagResource;
use App\Services\Tag\TagService;
use Illuminate\Http\Request;

class TagController extends ApiController
{
    public function __construct(
        protected TagRepository $repository,
        protected TagService $service
    )
    {}

    public function index(Request $request)
    {
        try {
            return TagResource::collection(
                $this->repository->getAllWithParams($request->all(), ['childrenTags'])
            );
        } catch (\Exception $e){
            return $this->errorJsonMessage($e->getMessage(), $e->getCode());
        }
    }

    public function show(Request $request, $id)
    {
        try {
            return TagResource::make($this->repository->getOneBy('id', $id));
        } catch (\Exception $e){
            return $this->errorJsonMessage($e->getMessage(), $e->getCode());
        }
    }

    public function create(Create $request)
    {
        try {
            /** @var $user User */
            $user = \Auth::user();

            return TagResource::make(
                $this->service->create($request->all(), $user)
            );
        } catch (\Exception $e){
            return $this->errorJsonMessage($e->getMessage(), $e->getCode());
        }
    }


}
