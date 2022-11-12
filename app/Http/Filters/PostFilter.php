<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class PostFilter extends AbstractFilter
{
    public const CATEGORIES = 'categories';
    public const TITLE = 'title';
    public const TAGS = 'tags';
    public const USER_ID = 'user_id';
    public const CONTENT = 'content';


    protected function getCallbacks(): array
    {
        return [
            self::CATEGORIES => [$this, 'categories'],
            self::TITLE => [$this, 'title'],
            self::TAGS => [$this, 'tags'],
            self::USER_ID => [$this, 'user_id'],
            self::CONTENT => [$this, 'content'],
        ];
    }

    public function categories(Builder $builder, $value)
    {
        $builder->whereIn('category_id', $value);
    }

    public function title(Builder $builder, $value)
    {
        $builder->where('title', 'like', '%' . $value . '%');
    }

    public function content(Builder $builder, $value)
    {
        $builder->where('content', 'like', '%' . $value . '%');
    }

    public function user_id(Builder $builder, $value)
    {
        $builder->where('user_id', '=', $value );
    }

    public function tags(Builder $builder, $value)
    {
        $builder->whereHas('tags', function ($b) use ($value) {
            $b->whereIn('tag_id', $value);
        });
    }

}

