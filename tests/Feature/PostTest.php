<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    private function createDummyBlogPost()
    {
        /**
         * Creates a dummy Blog post sets the fields saves and returns the blog post
         * @return $post
         */
        $post = new BlogPost(); //Make a new Object
        $post->title = "New Title"; // Add the title
        $post->content = "Content of the blog post"; //Add the Content
        $post->save(); //Save it

        return $post;
    }

    public function testPostForNoBlogPostsInDataBase()
    {
        $response = $this->get('/posts');

        $response->assertSeeText('No Post found!');
    }

    public function testPostSee1BlogPostWhenThereIs1()
    {
        //Arrange
        $post = $this->createDummyBlogPost();


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

    public function testPostFormIsInvalid()
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

    public function testPostUpdateWorks()
    {

        $post = $this->createDummyBlogPost();

        //Check if it has all the fields in the database
        $this->assertDatabaseHas('blog_posts', $post->getAttributes());

        //Params to send to the route
        $params = [
            'title' => 'A new modified Title',
            'content' => 'This is new modified contents for testing'
        ];
        //Route Variable
        $postIdRouteVar = '/posts/' . $post->id;

        //Send a put request to the /posts/id route along with the params to change the value
        $this->put($postIdRouteVar, $params)
            ->assertStatus(302) //Check if we got redirected meaning success
            ->assertSessionHas('Status-success'); //Check if the success message was flashed

        //Check to see if the success message is correct    
        $this->assertEquals(session('Status-success'), 'Your Record Has been updated');
        //Check to see if the data created first is gone from the database
        //Means the data is rewritten
        $this->assertDatabaseMissing('blog_posts', $post->getAttributes());
        //Check to see if what was sent in the params is now in the database
        $this->assertDatabaseHas('blog_posts', $params);
    }

    public function testPostDeleteWorks()
    {
        $post = $this->createDummyBlogPost();

        $this->assertDatabaseHas('blog_posts', $post->getAttributes());

        $postIdRouteVar = '/posts/' . $post->id;

        //Send a put request to the /posts/id to delete the entire post
        $this->delete($postIdRouteVar)
            ->assertStatus(302) //Check if we got redirected meaning success
            ->assertSessionHas('Status-success'); //Check if the success message was flashed

        $this->assertDatabaseMissing('blog_posts', $post->getAttributes());
    }
}
