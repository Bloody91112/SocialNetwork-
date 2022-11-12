<?php

namespace App\Http\Resources\API\Post;

use App\Http\Resources\API\Category\CategoryResource;
use App\Http\Resources\API\Comment\CommentResource;
use App\Http\Resources\API\Like\LikeResource;
use App\Http\Resources\API\Tag\TagResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{

    public function toArray($request)
    {


        //$date = Carbon::parse($this->created_at)->format('h:i d F');

        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'user' => $this->user,
            'date_row' => $this->created_at,
            'created_at' => $this->created_at->diffForHumans(),
            'category' => isset($this->category) ? new CategoryResource($this->category) : null,
            'tags'     => isset($this->tags) ? TagResource::collection($this->tags) : null,
            'comments' => isset($this->comments) ? CommentResource::collection($this->comments) : null,
            'likes'    => isset($this->likes) ? LikeResource::collection($this->likes) : null,
        ];
    }
}
