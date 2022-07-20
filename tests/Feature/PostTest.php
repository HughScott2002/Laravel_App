<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Comment;
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
        // $post = new BlogPost(); //Make a new Object
        // $post = BlogPost::factory()->count(1)->create();
        // $post->title = "New Title"; // Add the title
        // $post->content = "Content of the blog post"; //Add the Content
        // dd($post['#attributes']);
        // $post->save(); //Save it

        return BlogPost::factory()->create();
    }

    public function testPostForNoBlogPostsInDataBase()
    {
        $response = $this->get('/posts');

        $response->assertSeeText('No Post found!');
    }

    public function testPostSee1BlogPostWhenThereIs1WithNoComments()
    {
        //Arrange
        $post = $this->createDummyBlogPost();


        //Act
        $response = $this->get('/posts');

        //Assert
        $response->assertSeeText($post->title);
        $response->assertSeeText($post->content);
        $response->assertSeeText('No Comments yet');
        // dd($post->getAttributes());
        $this->assertDatabaseHas('blog_posts', $post->getAttributes());


        // $this->assertDatabaseHas('blog_posts', [
        //     'title' => 'New Title',
        //     'content' => 'Content of the blog post'
        // ]);
    }

    public function testPostSee1BlogPostWhenThereIs1WithComments()
    {
        //Arrange
        $post = $this->createDummyBlogPost();
        $count = 5; // you can change the count as you like

        //Act
        /*Uses the factory class to generate a number of fake data to test with and sends them to the
        post id 
        */
        Comment::factory()->count($count)->create(['blog_post_id' => $post->id]);
        //Get the page the
        $response = $this->get('/posts');
        //Assert
        //Test if the the page loaded and is displaying the amount of comments we added
        $response->assertSeeText($post->title);
        $response->assertSeeText($post->content);
        $response->assertSeeText("Comments: {$count}");
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
