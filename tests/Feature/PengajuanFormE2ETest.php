<?php

namespace Tests\Feature;

use App\Models\new_media_pengajuan;
use App\Models\tahun;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class PengajuanFormE2ETest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_upload_documents_and_submit_a_complete_application(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->createActiveYear();

        $this->actingAs($user)
            ->get('/pengajuan/show/siber')
            ->assertOk()
            ->assertSee('Kirim Pengajuan')
            ->assertSee('Perusahaan Pers')
            ->assertSee('Perwakilan Media');

        $document = $this->actingAs($user)->post('/pengajuan/uploads', [
            'data' => 'fileNibPerusahaan',
            'file' => UploadedFile::fake()->create('nib.pdf', 100, 'application/pdf'),
        ]);

        $document->assertOk()->assertJsonStructure(['name', 'original_name']);
        $fileName = $document->json('name');

        $this->actingAs($user)
            ->postJson('/pengajuan/store', $this->payload($fileName))
            ->assertOk()
            ->assertJsonPath('icon', 'success');

        $this->assertDatabaseHas('new_media_pengajuans', [
            'id_user' => (string) $user->id,
            'namaMedia' => 'media pengujian',
            'status' => 'ajukan',
            'tahun_pengajuan' => '2026',
        ]);

        $this->assertSame(1, new_media_pengajuan::where('id_user', $user->id)->count());
    }

    public function test_user_cannot_submit_a_second_application_in_the_same_year(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->createActiveYear();

        $this->actingAs($user)->postJson('/pengajuan/store', $this->payload('nib.pdf'))
            ->assertOk();

        $this->actingAs($user)->postJson('/pengajuan/store', $this->payload('nib-lain.pdf'))
            ->assertStatus(422)
            ->assertJsonPath('title', 'Operasi Gagal');

        $this->assertSame(1, new_media_pengajuan::where('id_user', $user->id)->count());
    }

    private function payload(string $fileName): array
    {
        return [
            'jenis_media' => 'siber',
            'namaMedia' => 'Media Pengujian',
            'namaPerusahaan' => 'Perusahaan Pengujian',
            'nibPerusahaan' => '1234567890123',
            'kumhamPerusahaan' => 'AHU-001',
            'npwpPerusahaan' => '12.345.678.9-012.000',
            'verifikasiDewanPers' => 'terverifikasi faktual',
            'noKlbi' => '58120',
            'alamatPerusahaan' => 'Jalan Pengujian 1',
            'alamatKecPerusahaan' => 'Tulang Bawang Tengah',
            'alamatKabPerusahaan' => 'Tulang Bawang Barat',
            'alamatProvPerusahaan' => 'Lampung',
            'tlpnPerusahaan' => '081234567890',
            'emailPerusahaan' => 'media@example.test',
            'namaPimred' => 'Pimpinan Redaksi',
            'serfikatUkwPimred' => 'UKW-001',
            'namaPimprus' => 'Pimpinan Perusahaan',
            'jenisSerfikatUkwPimred' => 'utama',
            'namaPerwakilan' => 'Wartawan Pengujian',
            'serfikatUkwPerwakilan' => 'UKW-002',
            'alamatPerwakilan' => 'Jalan Perwakilan 1',
            'alamatKecPerwakilan' => 'Tulang Bawang Tengah',
            'alamatKabPerwakilan' => 'Tulang Bawang Barat',
            'alamatProvPerwakilan' => 'Lampung',
            'nomorKtpPerwakilan' => '1801010101010001',
            'nomorKKPerwakilan' => '1801010101010002',
            'organisasiWartawan' => 'PWI',
            'organisasiPerusahaanPers' => 'JMSI',
            'fileNibPerusahaan' => $fileName,
            'fileKumhamPerusahaan' => 'ahu.pdf',
            'fileNpwpPerusahaan' => 'npwp.pdf',
            'fileSerfikatUkwPimred' => 'ukw-pimred.pdf',
            'fileSuratPernyataanPimred' => 'pernyataan.pdf',
            'fileSuratKeteranganWartawan' => 'keterangan-wartawan.pdf',
            'fileSerfikatUkwPerwakilan' => 'ukw-perwakilan.pdf',
            'fileBuktiKeanggotaanOrganisasiWartawan' => 'organisasi-wartawan.pdf',
            'fileBuktiKeanggotaanOrganisasiPerusahaanPers' => 'organisasi-perusahaan.pdf',
        ];
    }

    private function createActiveYear(): void
    {
        $year = new tahun();
        $year->tahun = '2026';
        $year->order = 1;
        $year->pengajuan = 1;
        $year->pengajuan_edit = 0;
        $year->verifikasi = 0;
        $year->data = 0;
        $year->publish = '1';
        $year->save();
    }
}
