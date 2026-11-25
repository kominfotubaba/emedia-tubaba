<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class RegistrationSettingTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_close_and_reopen_registration(): void
    {
        DB::table('tahuns')->insert(['tahun' => 2026, 'register' => 1, 'order' => 0, 'pengajuan' => 0, 'pengajuan_edit' => 0, 'verifikasi' => 0, 'data' => 0]);
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin)->get('/setting')->assertOk()->assertSee('Nonaktifkan Registrasi');
        $this->actingAs($admin)->post('/setting/registrasi', ['active' => '0'])->assertRedirect();
        $this->assertDatabaseHas('tahuns', ['tahun' => 2026, 'register' => 0]);
        auth()->logout();
        $this->get('/register')->assertSee('register akun ditutup');
        $this->get('/login')->assertDontSee('Apabila Belum Memiliki Akun Silahkan')->assertDontSee('href="'.route('register').'"', false);
        $this->post('/register', ['email' => 'new@example.com', 'password' => 'password', 'password_confirmation' => 'password'])->assertSee('register akun ditutup');
        $this->assertDatabaseMissing('users', ['email' => 'new@example.com']);
        $this->actingAs($admin)->post('/setting/registrasi', ['active' => '1'])->assertRedirect();
        $this->assertDatabaseHas('tahuns', ['tahun' => 2026, 'register' => 1]);
        auth()->logout();
        $this->get('/register')->assertSee('name="email"', false);
        $this->get('/login')->assertSee('href="'.route('register').'"', false);
    }

    public function test_non_admin_cannot_change_registration_status(): void
    {
        DB::table('tahuns')->insert(['tahun' => 2026, 'register' => 1, 'order' => 0, 'pengajuan' => 0, 'pengajuan_edit' => 0, 'verifikasi' => 0, 'data' => 0]);
        $this->actingAs(User::factory()->create(['role' => 'user']))->post('/setting/registrasi', ['active' => '0'])->assertForbidden();
        $this->assertDatabaseHas('tahuns', ['tahun' => 2026, 'register' => 1]);
    }
}
