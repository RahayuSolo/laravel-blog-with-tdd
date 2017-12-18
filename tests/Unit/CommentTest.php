<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
	//use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
    public function test_comment_should_has_creator()
 	{
 		// Giving comment object
 		// should include User object
 		// Giving comment object
 		$comment = factory('App\Comment')->create();
 		// should include User object 
 		$this->assertInstanceOf('App\User',$comment->creator); // I expect creator function has User instance
 	}

}
