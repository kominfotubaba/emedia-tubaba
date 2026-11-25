<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        DB::table('tahuns')->insert(['tahun' => 2026, 'register' => 1, 'order' => 0, 'pengajuan' => 0, 'pengajuan_edit' => 0, 'verifikasi' => 0, 'data' => 0]);
    }

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200)->assertDontSee('Nama Sesuai KTP')->assertDontSee('No. HP Aktif')->assertDontSee('NIK')->assertDontSee('No. KK');
    }

    public function test_new_users_can_register()
    {
        $response = $this->post('/register', [
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'test@example.com', 'name' => 'test@example.com', 'nik' => null, 'no_kk' => null, 'no_hp' => null]);
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
