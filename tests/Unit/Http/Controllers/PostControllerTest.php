<?php

namespace Tests\Unit\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Notifications\PostCreated;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_posts_index_page_can_rendered_properly()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        $response =  $this->get('/');
//        $this->assertEquals(200, $response->status());
        $response->assertStatus(200);
    }

    public function test_users_can_create_posts()
    {
        $this->withoutExceptionHandling();
        Notification::fake();

//        Storage::fake('avatars'); // create folder avatars in storage/framework/testing/disks

        // Create User with userName = 'thienan' is admin
        $user = User::factory()->create(['userName' => 'thienan']);
        //check user is admin
        $this->assertEquals('thienan', $user->userName);
        $this->actingAs($user);
        $category = Category::factory()->create();
        $file = UploadedFile::fake()->image('avatar.jpg'); // tao ra file co ten avatar.jpg nen no khong tim
        //thay trong thu muc storage/app/public mak phai dang chuoi ki tu ngau nhien anbawdbahwdcxnasdbasdhgw1231.jpg
        // neu minh de ten img co trong thumbnail thi assert true;
        $response = $this->post('/admin/posts/create', [
            'title'=>'Test Laravel with UnitTest',
            'slug' => 'test_laravel_with_unitTest',
            'excerpt' => 'lalalala lalalala',
            'thumbnail' => $file,
            'body' => 'bala bala bala bala bala bala bala bala bala bala bala bala bala bala bala bala bala bala bala bala bala',
            'user_id' => $user->id,
            'category_id' => $category->id
        ]);
        $post = Post::first();
        $this->assertEquals(1, Post::count());
        //Assert a post has proper data
        $this->assertEquals('Test Laravel with UnitTest', $post->title);
        $this->assertEquals($user->id, $post->author->id);
        $this->assertInstanceOf(User::class, $post->author);

//        $path = Storage::putFile('avatars', $image); // Save file in public,

        Storage::disk('public')->assertExists('thumbnail/'.$file->hashName());
        Notification::assertSentTo($user, PostCreated::class);

        //check name image
//        $this->assertEquals('MyThumbnail.jpg', $image->name);
        //check image after save -> has in folder thumbnail
//        Storage::disk('thumbnail')->assertExists($image->name); //-> khong hieu Storage::disk la gi
//        $this->assertFileExists(public_path('storage/thumbnail/').$image->name);
        //check directly in folder storage
//        $image->store('thumbnail');
//        $this->assertFileExists(storage_path('app/public/thumbnail/').$image->name);
        $response->assertStatus(302);
    }
}
