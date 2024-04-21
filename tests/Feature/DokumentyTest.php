<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Dokumenty;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class DokumentyTest extends TestCase
{
    use RefreshDatabase;

    private User $user;



    private function createUser(): User
    {
        return User::factory()->create();
    }

    public function test_dokumenty()
    {
  
        $response = $this->actingAs($this->user)->get('/dokumenty');

        $response->assertStatus(200);
    }

    public function test_dokumenty_pusta_tablica()
    {
       
        $response = $this->actingAs($this->user)->get('/dokumenty');

        $response->assertSee(__('Nie znaleziono dokumentów'));
        $response->assertStatus(200);
    }

    public function test_dokumenty_nie_pusta_tablica()
    {
        
        Dokumenty::create([
            'nazwa' => 'Test',
            'file_path' => 'Test',
            'users_id' => $this->user->id
        ]);
        $response = $this->actingAs($this->user)->get('/dokumenty');

        $response->assertDontSee(__('Nie znaleziono dokumentów'));
        $response->assertSee(__('Test'));
        $response->assertStatus(200);
    }

    public function test_tworzenie_dokumentu()
    {
        Storage::fake('local');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $dokument = [
            'nazwa' => 'Test',
            'plik' => $file,
            'users_id' => $this->user->id,
        ];
        
        $response = $this->actingAs($this->user)->post('dokumenty', $dokument);
       
        Storage::disk('local')->assertExists('dokumenty/'.$file->hashName());

        $response->assertStatus(302);
        $response->assertRedirect('dokumenty');

        $dokumenty = [
            'nazwa' => 'Test',
            'file_path' => 'dokumenty/'.$file->hashName(),
            'users_id' => $this->user->id,
        ];

        $this->assertDatabaseHas('dokumenty', $dokumenty); 
    }

    public function test_pomyslne_usuniecie_dokumentu()
    {
      
        $dokument = Dokumenty::create([
            'nazwa' => 'Test',
            'file_path' => 'Test',
            'users_id' => $this->user->id
        ]);
        
        $response = $this->actingAs($this->user)->delete('dokumenty/'.$dokument->id);
        $response->assertStatus(200);   

        $this->assertDatabaseMissing('dokumenty', $dokument->toArray());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createUser();
    }
}
