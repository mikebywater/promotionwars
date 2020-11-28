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
        $response = $this->get('/');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
}
