<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\SearchService;
use App\Repositories\User\User;
use App\Repositories\Wrestler\Wrestler;

class SearchServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $gameId;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->be($user);
        $this->gameId = $this->loadGame($user);
    }

    public function testSearchWithErroneousData()
    {
        $service = resolve(SearchService::class);
        $result = $service->search(null);

        $this->assertTrue(is_a($result, 'Illuminate\Database\Eloquent\Collection'));
        $this->assertTrue($result->isEmpty());
    }

    public function testSearchWithNoResults()
    {
        $service = resolve(SearchService::class);
        $result = $service->search('under');

        $this->assertTrue(is_a($result, 'Illuminate\Database\Eloquent\Collection'));
        $this->assertTrue($result->isEmpty());
    }

    public function testSearchWithResults()
    {
        Wrestler::factory()->create([
            'name' => 'The Undertaker',
            'game_id' => $this->gameId
        ]);

        Wrestler::factory()->create([
            'name' => 'The Undertakers Brother',
            'game_id' => $this->gameId
        ]);

        Wrestler::factory()->create([
            'name' => 'Kane',
            'game_id' => $this->gameId
        ]);

        $this->assertDatabaseCount('wrestlers', 3);
        $service = resolve(SearchService::class);
        $result = $service->search('under');

        $this->assertTrue(is_a($result, 'Illuminate\Database\Eloquent\Collection'));
        $this->assertEquals($result->count(), 2);
    }
}
