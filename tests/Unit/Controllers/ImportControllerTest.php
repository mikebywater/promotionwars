<?php

namespace Tests\Unit\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Repositories\User\User;
use Illuminate\Http\UploadedFile;

class ImportControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testNoAccessWithoutUser()
    {
        $response = $this->get('/wrestlers/upload');
        
        $response->assertStatus(302);
        $response->assertRedirect('/login');

        $response = $this->get('/promotions/upload');
        
        $response->assertStatus(302);
        $response->assertRedirect('/login');

        $response = $this->post('/wrestlers/import');
        
        $response->assertStatus(302);
        $response->assertRedirect('/login');

        $response = $this->get('/promotions/import');
        
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function testAccessPromotionsUploadPage()
    {
        $user = User::factory()->create();
        $this->loadGame($user);

        $response = $this->actingAs($user)
                         ->get('/promotions/upload');
        
        $response->assertStatus(200);
        $response->assertViewIs('promotions.upload');
    }

    public function testAccessWrestlersUploadPage()
    {
        $user = User::factory()->create();
        $this->loadGame($user);

        $response = $this->actingAs($user)
                         ->get('/wrestlers/upload');
        
        $response->assertStatus(200);
        $response->assertViewIs('wrestlers.upload');
    }

    public function testUploadWrestlersWithoutFile()
    {
        $user = User::factory()->create();
        $this->loadGame($user);

        $response = $this->actingAs($user)
                         ->post('/wrestlers/import');
        
        $response->assertStatus(302);
        $response->assertRedirect('/wrestlers');
        $this->assertDatabaseCount('wrestlers', 0);
    }

    public function testUploadEmptyWrestlersFile()
    {
        $user = User::factory()->create();
        $this->loadGame($user);

        $file = UploadedFile::fake()->createWithContent(
            'wrestlers.txt',
            ''
        );

        $response = $this->actingAs($user)
                         ->post('/wrestlers/import', ['file' => $file]);
        
        $response->assertStatus(302);
        $response->assertRedirect('/wrestlers');
        $this->assertDatabaseCount('wrestlers', 0);
    }

    public function testUploadOneWrestlerWithFile()
    {
        $user = User::factory()->create();
        $this->loadGame($user);

        $fileContent = $this->generateWrestlerFileContent();

        $file = UploadedFile::fake()->createWithContent(
            'wrestlers.txt',
            $fileContent
        );

        $response = $this->actingAs($user)
                         ->post('/wrestlers/import', ['file' => $file]);
        
        $response->assertStatus(302);
        $response->assertRedirect('/wrestlers');
        $this->assertDatabaseCount('wrestlers', 1);
    }

    public function testUploadMultipleWrestlersWithFile()
    {
        $user = User::factory()->create();
        $this->loadGame($user);

        $numberOfWrestlers = 3;

        $fileContent = $this->generateWrestlerFileContent($numberOfWrestlers);

        $file = UploadedFile::fake()->createWithContent(
            'wrestlers.txt',
            $fileContent
        );

        $response = $this->actingAs($user)
                         ->post('/wrestlers/import', ['file' => $file]);
        
        $response->assertStatus(302);
        $response->assertRedirect('/wrestlers');
        $this->assertDatabaseCount('wrestlers', $numberOfWrestlers);
    }

    public function testUploadPromotionsWithoutFile()
    {
        $user = User::factory()->create();
        $this->loadGame($user);

        $response = $this->actingAs($user)
                         ->post('/promotions/import');
        
        $response->assertStatus(302);
        $response->assertRedirect('/promotions');
        $this->assertDatabaseCount('promotions', 0);
    }

    public function testUploadEmptyPromotionsFile()
    {
        $user = User::factory()->create();
        $this->loadGame($user);

        $file = UploadedFile::fake()->createWithContent(
            'promotions.txt',
            ''
        );

        $response = $this->actingAs($user)
                         ->post('/promotions/import', ['file' => $file]);
        
        $response->assertStatus(302);
        $response->assertRedirect('/promotions');
        $this->assertDatabaseCount('promotions', 0);
    }

    public function testUploadOnePromotionWithFile()
    {
        $user = User::factory()->create();
        $this->loadGame($user);

        $fileContent = $this->generatePromotionFileContent();

        $file = UploadedFile::fake()->createWithContent(
            'promotions.txt',
            $fileContent
        );

        $response = $this->actingAs($user)
                         ->post('/promotions/import', ['file' => $file]);
        
        $response->assertStatus(302);
        $response->assertRedirect('/promotions');
        $this->assertDatabaseCount('promotions', 1);
    }

    public function testUploadMultiplePromotionsWithFile()
    {
        $user = User::factory()->create();
        $this->loadGame($user);

        $numberOfPromotions = 3;

        $fileContent = $this->generatePromotionFileContent($numberOfPromotions);

        $file = UploadedFile::fake()->createWithContent(
            'promotions.txt',
            $fileContent
        );

        $response = $this->actingAs($user)
                         ->post('/promotions/import', ['file' => $file]);
        
        $response->assertStatus(302);
        $response->assertRedirect('/promotions');
        $this->assertDatabaseCount('promotions', $numberOfPromotions);
    }

    private function generateWrestlerFileContent($numberOfWrestlers = 1)
    {
        $contentAsArray = [];

        for ($i = 0; $i < $numberOfWrestlers; $i++) {
            $contentAsArray = array_merge($contentAsArray, $this->generateWrestlerFileArray());
        }

        return implode("\n",$contentAsArray);
    }

    private function generateWrestlerFileArray()
    {
        return [
            'The Undertaker', // 1 Name
            '', '', '', '',
            70, // 6 Draw
            80, // 7 Ability
            'Biography paragraph', // 8 Bio
            '', '', '', '', '', '',
            'Face', // 15 Disposition
            '', '', '', '', '', '',
            100, // 22 Condition
            '',
            'Technical', // 24 Style
            '',
            41, // 26 Age
            40, // 27 Mic Skills
            90, // 28 Harcore
            'Heavy', // 29 Weight
            82, // 30 Charisma
            'End', // 31
        ];
    }

    private function generatePromotionFileContent($numberOfPromotions = 1)
    {
        $contentAsArray = [];

        for ($i = 0; $i < $numberOfPromotions; $i++) {
            $contentAsArray = array_merge($contentAsArray, $this->generatePromotionFileArray());
        }

        return implode("\n",$contentAsArray);
    }

    private function generatePromotionFileArray()
    {
        $content = array_fill(1, 238, '');

        $content[1] = 'RAW'; // 1 Short Name
        $content[2] = 'RAW'; // 2 Name
        $content[4] = 100; // 4 Size
        $content[5] = 1000.00; // 5 Funds
        $content[6] = 'www.raw.com'; // 6 Website
        $content[7] = 'Promo Bio'; // 7 Bio

        $content[46] = 90; // 46 Popularity

        $content[238] = 'End';

        return $content;
    }
}
