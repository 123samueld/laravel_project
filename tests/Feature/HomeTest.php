<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeTest extends TestCase
{
    public function test_home_page_text()
    {
        //Arrange

        //Act
        $response = $this->get('/');
        //Assert
        $response->assertSeeText('Hello some world');
        $response->assertSeeText('Hello some world');
    }

    public function test_contact_page_connetction()
    {
        //Arrange

        //Act
        $response =  $this->get('/contact');
        //Assert
        $response->assertSeeText('Contact some world');
        $response->assertSeeText('Contact some world');
    }
}
