<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class InfoController extends ApiController
{
    public function __invoke(Request $request)
    {
        return $this->successJsonMessage([
            'name' => config('app.name'),
            'version' => config('api.version')
        ]);
    }
}
