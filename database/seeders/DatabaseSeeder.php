<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\Subscription;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //User::factory(100)->create();
        //Post::factory(100)->create();

        Like::factory(500)->create();
        //Comment::factory(500)->create();
        //Subscription::factory(100)->create();

        /*$posts = Post::all();
        $tags = Tag::get()->pluck('id');

        foreach ($posts as $post){
            $tagsIds = $tags->random(3);
            $post->tags()->attach($tagsIds);
        }*/
    }
}
