<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
//php vendor/phpunit/phpunit/phpunit
class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function test_a_guset_can_access_blog_index()
    {
    	//$response = $this->get('/blog'); //make GET access to blog route
        
    	//$response->assertStatus(200); //assert http status return is 200 
        // Giving post object
        $post = factory('App\Post')->create();//create post data
        // When guest access blog url
        $response = $this->get('/blog'); //visit blog homepage 
        // Then I've see blog title that create before
        $response->assertSee($post->title); // expect to see post 
    }

    public function test_a_guest_can_see_single_post()
    {
        // giving post data
        // when guest access blog/{id}
        // expect to see post title
        // giving post data
        $post = factory('App\Post')->create();
        // when guest access blog/{id}
        $response = $this->get('/blog/'.$post->id);
        // expect to see post title
        $response->assertSee($post->title);
    }

    public function test_guest_can_see_comment_when_visit_single_post(){
        // Given a Post
        // and Post have comments
        // then I visit single post page
        // I’ve see the comment
        // Given a Post
        $post = factory('App\Post')->create();
        // and Post have comments
        $comment = factory('App\Comment')
                    ->create(['post_id'=>$post->id]);
        // then I visit single post page
        $response = $this->get('blog/'.$post->id);
        // I’ve see the comment
        $response->assertSee($comment->body);
    }

    public function test_a_post_can_add_a_comments()
    {
        //Giving a Post
        // Add a commemnt
        // Then post should have a comment
        //Giving a Post
        $post = factory('App\Post')->create();
        // Add a comemnt
        $post->storeComment([
                'body'=>'Testing',
                'user_id'=>1
        ]);
        // Then post should have comment
        $this->assertCount(1,$post->comment);
    }

    function test_post_has_a_creator()
    {
        // Giving post 
        // expect found User who create post
        $post = factory('App\Post')->create();
        // expect found User who create post
        $this->assertInstanceOf('App\User', $post->creator);
    }

    function test_a_user_can_create_post()
    {
        // Given a Guest
        $guest = factory('App\User')->create();
        // make a guest become User
        $user = $this->be($guest);
        // And Giving Post object 
        $post = factory('App\Post')->make();
        // When the user create Post
        $this->post('/post/',$post->toArray());
        // When their visit
        $response = $this->get('blog/'.$post->id);
        // I’ve see the comment
        $response->assertSee($post->title);
    }

    public function test_a_guest_can_not_access_create_post_page(){
        $this->get('/blog/create')
            ->assertRedirect('/login');
    }


}
