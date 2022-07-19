<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testPostForNoBlogPostsInDataBase()
    {
        $response = $this->get('/posts');

        $response->assertSeeText('No Post found!');
    }

    public function testPostSee1BlogPostWhenThereIs1()
    {
        //Arrange
        $post = new BlogPost();
        $post->title = "New Title";
        $post->content = "Content of the blog post";
        $post->save();

        //Act
        $response = $this->get('/posts');

        //Assert
        $response->assertSeeText("New Title");
        $response->assertSeeText("Content of the blog post");

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New Title',
            'content' => 'Content of the blog post'
        ]);
    }

    public function testPostFormIsValid()
    {

        $params = [
            'title' => 'Valid title',
            'content' => 'At least 10 characters'
        ];

        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas("Status-success");

        $this->assertEquals(session('Status-success'), 'The Blog Post was created!');
    }

    public function testPostFormInvalid()
    {

        $params = [
            'title' => ' ',
            'content' => ' '
        ];

        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();
        // dd($messages->getMessages());

        $this->assertEquals($messages['title'][0], "The title must be at least 5 characters.");
        $this->assertEquals($messages['content'][0], "The content field is required.");
    }

    public function testPostUpdate()
    {
        //Arrange
        $post = new BlogPost();
        $post->title = "New Title";
        $post->content = "Content of the blog post";
        $post->save();

        $this->assertDatabaseHas('blog_posts', $post->getAttributes());
        $params = [
            'title' => 'A new modified Title',
            'content' => 'This is new modified contents for testing'
        ];

        $this->put("/posts/{{$post->id}}", $params)
            ->assertStatus(302)
            ->assertSessionHas('Status-success');

        $this->assertEquals(session('Status-success'), 'Your Record Has been updated');
        $this->assertDatabaseMissing('blog_posts', $post->toArray());
        $this->assertDatabaseHas('blog_posts', $params);
    }
}
