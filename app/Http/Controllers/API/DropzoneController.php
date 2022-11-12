<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dropzone\UpdateRequest;
use App\Http\Resources\API\User\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DropzoneController extends Controller
{
    public function update(UpdateRequest $request ,User $user){
        $data = $request->validated();

        $data['avatar'] = Storage::disk('public')->put('/images', $data['avatar']);
        $user->update($data);

        return new UserResource($user);

    }
}
