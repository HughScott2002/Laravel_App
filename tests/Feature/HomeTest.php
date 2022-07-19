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
    public function testHomePageWorking()
    {
        $response = $this->get('/');

        $response->assertSeeText('Welcome to Laravel');
        $response->assertSeeText('This is the main content of the page!');
        $response->assertStatus(200);
    }

    public function testContactPageIsWorking()
    {
        $response = $this->get('/contact');
        $response->assertSeeText('Contact');
        $response->assertSeeText('Contact Us');
        $response->assertStatus(200);
    }
}
