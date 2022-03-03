<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\BlogPost;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_for_empty_page_when_no_posts()
    {
        //Act
        $response = $this->get('/posts');
        //Assert
        $response->assertSeeText('No posts found!');   
    }

    private function create_dummy_post(): BlogPost
    {
        $post = new BlogPost();
        $post->title = 'Test title 1';
        $post->content = 'Test content 1';
        $post->save();
    
        return $post;
    }


    public function test_see_posts_when_posts_are_available()
    {
        $posts = $this->create_dummy_post();
        //Act
        $response = $this->get('/posts');
        //Assert
        $response->assertSeeText('Test title 1');
        $this->assertDatabaseHas('blog_posts',
        [
            'title' => 'Test title 1'
        ]);
    }

    public function test_store_valid_post()
    {
        //Arrange
        $post = $this->create_dummy_post();
        $params = [
            'title' => "Valid title",
            'content' => 'At least 10 chars'
        ];
        //Act
        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');
        //Assert
        $this->assertEquals(session('status'), 'The blog post was created');
    }
    
    public function test_failed_post_validation()
    {
        $params = [
            'title' => 'x', 
            'content' => 'y'
        ];

        $this->post('/posts', $params)
        ->assertStatus(302)
        ->assertSessionHas('errors');
        
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');

    }

    public function test_valid_updates()
    {
        $post = $this->create_dummy_post();
        
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'Test title 1',
            'content' => 'Test content 1'
        ]);

        $params = [
            'title' => 'Test title 1 update',
            'content' => 'Test content 1 update'
        ];

        $this->put("/posts/{$post->id}", $params)
        ->assertStatus(302)
        ->assertSessionHas('status'); 

        $this->assertEquals(session('status'), 'The blog post has been updated');

        $this->assertDatabaseMissing('blog_posts', [
            'title' => 'Test title 1',
            'content' => 'Test content 1'
        ]);

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'Test title 1 update',
            'content' => 'Test content 1 update'
        ]);
    }

    public function test_deleting_post()
    {
        $post = $this->create_dummy_post();
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'Test title 1',
            'content' => 'Test content 1'
        ]);

        $this->delete("/posts/{$post->id}")
        ->assertStatus(302)
        ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'The blog post was deleted');

        $this->assertDatabaseMissing('blog_posts', [
            'title' => 'Test title 1',
            'content' => 'Test content 1'
        ]);
    }

}
