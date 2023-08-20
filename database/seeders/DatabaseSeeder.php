<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {

        $this->call(RoleAndPermissionSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(SettingSeeder::class);


        $users = \App\Models\User::factory(10)->create();

        $users->each(function ($user) {
            $user->assignRole('author');
            \App\Models\UserInfo::factory()->create([
                'user_id' => $user->id,
            ]);
        });



        \App\Models\Category::factory(10)->create();
        \App\Models\Tag::factory(10)->create();

        $numPosts = 50;

        $now = now();

        \App\Models\Post::factory($numPosts)->create()->each(function ($post) use (&$now) {
            $post->created_at = $now;
            $post->save();

            \App\Models\Comment::factory(10)->create([
                'post_id' => $post->id,
            ]);

            \App\Models\Comment::factory(4)->create([
                'post_id' => $post->id,
                'parent_id' => fake()->randomElement(Comment::where('post_id', $post->id)->pluck('id')->toArray())
            ]);

            $now->addSecond();
        });

        \App\Models\PostTag::factory($numPosts)->create();
        \App\Models\PostCategory::factory($numPosts)->create();

        \App\Models\Page::factory(5)->create();
    }
}
