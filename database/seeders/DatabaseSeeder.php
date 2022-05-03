<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::truncate();
        Category::truncate();
        Post::truncate();
//        $user = User::factory()->create([
//            'name'=>'Thien An'
//        ]);
//        Post::factory(8)->create([
//            'user_id'=>$user->id
//        ]);
        Post::factory(30)->create();
//         $user = User::factory()->create();
//
//         $personal = Category::create([
//             'name'=>'Personal',
//             'slug'=>'personal'
//         ]);
//        $family = Category::create([
//            'name'=>'Family',
//            'slug'=>'family'
//        ]);
//        $work = Category::create([
//            'name'=>'Work',
//            'slug'=>'work'
//        ]);
//
//        Post::create([
//            'user_id'=>$user->id,
//            'category_id'=>$family->id,
//            'slug'=>'my-first-post',
//            'title'=>'What is Lorem Ipsum?',
//            'excerpt'=>'<p>It is a long established fact that a reader will be distracted</p>',
//            'body'=>"<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>"
//        ]);
//        Post::create([
//            'user_id'=>$user->id,
//            'category_id'=>$personal->id,
//            'slug'=>'my-second-post',
//            'title'=>'What is Lorem Ipsum?',
//            'excerpt'=>'<p>It is a long established fact that a reader will be distracted</p>',
//            'body'=>"<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>"
//        ]);
    }
}
