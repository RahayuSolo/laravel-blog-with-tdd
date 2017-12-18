<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubmitComment extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
    public function test_user_can_submit_comment()
    {
    	// Given a Guest
    	// make guest to Authenticate user 
    	// And Post is exist
    	// And Giving comment object 
    	// When the user submit comment to the post
    	// Then their should see comment
    	$guest = factory('App\User')->create();
    	// create Authenticate user 
        $user = $this->be($guest);
        // And Post is exist
        $post = factory('App\Post')->create();
        // And Giving comment object 
        $comment = factory('App\Comment')->make();
        // When the user submit comment to the post
    	$this->post('/blog/'.$post->id.'/comment',$comment->toArray());
        // Then their should see comment
        $this->get('/blog/'.$post->id)->assertSee($comment->body);
	}
	function test_guest_can_not_submit_comment(){
        // Given a Guest
          $guest = factory('App\User')->create();
         // And Post is exist
         $post = factory('App\Post')->create();
         // And Giving comment object 
         $comment = factory('App\Comment')->make();
         // When the user submit comment to the post
          $this->post('/blog/'.$post->id.'/comment',$comment->toArray());
         // Then their should see comment
    $this->get('/blog/'.$post->id)->assertDontSee($comment->body);
     
    }

}
