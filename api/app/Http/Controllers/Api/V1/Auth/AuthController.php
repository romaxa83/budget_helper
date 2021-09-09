<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Exceptions\Code;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Auth;
use App\Models\User\User;
use App\Repositories\User\UserRepository;
use App\Resources\User\UserResource;
use App\Services\Auth\UserPassportService;

class AuthController extends ApiController
{
    public function __construct(
        protected UserPassportService $passportService,
        protected UserRepository $userRepository
    )
    {}

    public function register()
    {
        try {

            return $this->successJsonMessage([]);
        } catch (\Exception $e){
            return $this->errorJsonMessage($e->getMessage(), $e->getCode());
        }
    }

    public function login(Auth\Login $request)
    {
        try {
            /** @var $user User */
            $user = $this->userRepository->getOneBy('email', $request->email);

            if(!$user || !\Hash::check($request->password, $user->password)){
                throw new \InvalidArgumentException(__('auth.credentials are incorrect'), Code::NOT_AUTH);
            }

            $tokens = $this->passportService->auth($user->id, $request->password);

            \Auth::login($user);

            return $this->successJsonMessage($tokens);
        } catch (\Exception $e){
            return $this->errorJsonMessage($e->getMessage(), $e->getCode());
        }
    }

    public function user()
    {
        try {
            $user = \Auth::user();

            return UserResource::make($user);
        } catch (\Exception $e){
            return $this->errorJsonMessage($e->getMessage(), $e->getCode());
        }
    }

    public function logout()
    {
        try {
            /** @var $user User */
            $user = \Auth::user();

            $this->passportService->logout($user);

            return $this->successJsonMessage(true);
        } catch (\Exception $e){
            return $this->errorJsonMessage($e->getMessage(), $e->getCode());
        }
    }
}
