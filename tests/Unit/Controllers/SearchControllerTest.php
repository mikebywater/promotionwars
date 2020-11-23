<?php

namespace Tests\Unit\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Repositories\User\User;
use App\Repositories\Wrestler\Wrestler;

/**
 * Test for search controller
 */
class SearchControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testNoSearchTermProvided()
    {
        $user = User::factory()->create();
        $this->loadGame($user);

        $response = $this->actingAs($user)
                         ->get('/search');
        
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    public function testSearchTermNoUser()
    {
        $response = $this->get('/search');
        
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function testSearchNoResults()
    {
        $user = User::factory()->create();
        $this->loadGame($user);

        $response = $this->actingAs($user)
                         ->get('/search?q=name');
        
        $response->assertStatus(200);
        $response->assertViewIs('search.index');
        $response->assertViewHas('searchTerm', 'name');

        $emptyCollection = Wrestler::with('promotion')->get();
        $this->assertTrue($emptyCollection->isEmpty());

        $response->assertViewHas('results', $emptyCollection);
    }

    public function testResults()
    {
        $user = User::factory()->create();
        $this->loadGame($user);

        $wrestler = Wrestler::factory()->create([
            'name' => 'The Undertaker',
            'game_id' => $user->id
        ]);

        $response = $this->actingAs($user)
                         ->get('/search?q=under');
        
        $response->assertStatus(200);
        $response->assertViewIs('search.index');
        $response->assertViewHas('searchTerm', 'under');

        $collectionWithUndertaker = Wrestler::with('promotion')->get();
        $this->assertFalse($collectionWithUndertaker->isEmpty());

        $response->assertViewHas('results', $collectionWithUndertaker);
    }

    public function testNoResultsForUser()
    {
        $user = User::factory()->create();
        $gameId = $this->loadGame($user);

        $wrestler = Wrestler::factory()->create([
            'name' => 'The Undertaker',
            'game_id' => $gameId + 1
        ]);

        $response = $this->actingAs($user)
                         ->get('/search?q=under');
        
        $response->assertStatus(200);
        $response->assertViewIs('search.index');
        $response->assertViewHas('searchTerm', 'under');

        $emptyCollection = Wrestler::with('promotion')->get();
        $this->assertTrue($emptyCollection->isEmpty());

        $response->assertViewHas('results', $emptyCollection);
    }
}
