<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_home_page_text()
    {
        //Act
        $response = $this->get('/');
        //Assert
        $response->assertSeeText('Hello some world');
        $response->assertSeeText('Hello some world');
    }

    public function test_contact_page_text(){
        $response= $this->get('/contact');
        $response->assertSeeText('Contact some world');
        $response->assertSeeText('Contact some world');

    }
}
