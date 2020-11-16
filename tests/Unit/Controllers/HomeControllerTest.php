<?php

namespace Tests\Unit\Controllers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\User\User;

use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testNoAccess()
    {
        $response = $this->get('/home');
        
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function testWithAccess()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                        ->get('/home');
        
        $response->assertStatus(200);
        $response->assertViewIs('home');
    }
}
