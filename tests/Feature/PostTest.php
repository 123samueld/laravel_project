<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\BlogPost;

class PostTest extends TestCase
{
    use RefreshDatabase;

    private function create_dummy_blog_post(): BlogPost
    {
        $post = new BlogPost();
        $post->title = 'Test Title';
        $post->content = 'Test content here';
        $post->save();

        return $post;
    }

    public function test_for_no_available_posts()
    {
        //Arrange
        //Act
        $response = $this->get('/posts');
        //Assert
        $response->assertSeeText('No posts found');
    }

    public function test_availability_when_posts_are_present()
    {
        //Arrange
        $post = $this->create_dummy_blog_post();
        //Act
        $response = $this->get('/posts');
        //Assert
        $response->assertSeeText('Test Title');

    }

    public function test_store_valid_post()
    {
        //Arrange
        $params = [
            'title' => 'Valid title',
            'content' => 'Valid content for testing'
        ];
        //Act
        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');
        //Assert
        $this->assertEquals(session('status'), 'The blog post was created');
    }

    public function test_failing_to_sotre_post()
    {
        //Arrange
        $params = [
            'title' => 'x',
            'content' => 'z'
        ];
        //Act
        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        //Assert
        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');
    }

    public function test_delete_post() 
    {
        $post = $this->create_dummy_blog_post();
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'Test Title',
            'content' => 'Test content here'
        ]);
        $this->delete('/posts/{$post->id}')
            ->assertStatus(302)
            ->assertSessionHas('status');
        //Assert
        $this->assertEquals(session('status'), 'The blog post was deleted');
        $this->assertDatabaseMissing('blog_posts', [
            'title' => 'Test Title',
            'content' => 'Test content here'
        ]);
    }

}
