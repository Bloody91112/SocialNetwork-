<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\User\UserInitResource;
use Illuminate\Http\Request;

class InitializingController extends Controller
{
    public function __invoke()
    {
        return new UserInitResource(auth()->user());
    }
}
