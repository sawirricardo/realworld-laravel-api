<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(20)
            ->has(Article::factory(10))
            ->has(Comment::factory(20))
            ->create();

        \App\Models\Tag::create(['name' => 'Graphic Design']);
        \App\Models\Tag::create(['name' => 'Laravel']);
        \App\Models\Tag::create(['name' => 'VueJS']);
        \App\Models\Tag::create(['name' => 'ReactJS']);
        \App\Models\Tag::create(['name' => 'NodeJS']);
        \App\Models\Tag::create(['name' => 'Rust']);
        \App\Models\Tag::create(['name' => 'Golang']);
        \App\Models\Tag::create(['name' => 'Livewire']);

        foreach (\App\Models\Article::all() as $article) {
            $article->tags()->sync(range(1, 8));
            $article->favoriters()->sync(range(1, 8));
        }

        $users = \App\Models\User::all();
        foreach ($users as $user) {
            DB::table('followers')->insert([
                'user_id' => $user->id,
                'follower_id' => $users->filter(function ($userModel) use ($user) {
                    return $userModel->id !== $user->id;
                })->random()->id,
            ]);
        }
    }
}
