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
            'noKlbi' => '58120, 60312',
            'namaPimprus' => 'pimpinan perusahaan',
            'alamatKecPerusahaan' => 'tulang bawang tengah',
            'alamatKecPerwakilan' => 'tulang bawang tengah',
            'jenisSerfikatUkwPerwakilan' => 'muda',
            'status' => 'ajukan',
            'tahun_pengajuan' => '2026',
        ]);

        $this->assertSame(1, new_media_pengajuan::where('id_user', $user->id)->count());
        $record = new_media_pengajuan::where('id_user', $user->id)->firstOrFail();
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin)->get('/pengajuan/verifikasi/'.$record->pengajuan_no)
            ->assertOk()
            ->assertSee('name="namaPimprus" value="pimpinan perusahaan"', false)
            ->assertSee('name="alamatKecPerusahaan" value="tulang bawang tengah"', false)
            ->assertSee('name="alamatKecPerwakilan" value="tulang bawang tengah"', false);
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

    public function test_user_is_warned_when_an_entered_field_is_already_registered(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->createActiveYear();
        $this->actingAs($user)->postJson('/pengajuan/store', $this->payload('nib.pdf'));

        $this->actingAs($user)
            ->postJson('/pengajuan/check-duplicate', [
                'field' => 'namaPimred',
                'value' => 'PIMPINAN REDAKSI',
            ])
            ->assertOk()
            ->assertJsonPath('duplicate', true)
            ->assertJsonPath('message', 'Nama Pimpinan Redaksi sudah terdaftar.');
    }

    public function test_address_fields_are_not_checked_for_duplicates(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->createActiveYear();
        $this->actingAs($user)->postJson('/pengajuan/store', $this->payload('nib.pdf'));

        $this->actingAs($user)
            ->postJson('/pengajuan/check-duplicate', [
                'field' => 'alamatKabPerusahaan',
                'value' => 'Tulang Bawang Barat',
            ])
            ->assertOk()
            ->assertJsonPath('duplicate', false);
    }

    public function test_kbli_can_be_reused_by_another_user(): void
    {
        $this->createActiveYear();
        $firstUser = User::factory()->create(['role' => 'user']);
        $secondUser = User::factory()->create(['role' => 'user']);
        $this->actingAs($firstUser)->postJson('/pengajuan/store', $this->payload('nib.pdf'))->assertOk();

        $this->actingAs($secondUser)->postJson('/pengajuan/check-duplicate', [
            'field' => 'noKlbi', 'value' => '58120, 60312',
        ])->assertOk()->assertJsonPath('duplicate', false);

        $payload = $this->payload('nib-lain.pdf');
        $payload['namaMedia'] = 'Media Kedua';
        $payload['namaPerusahaan'] = 'Perusahaan Kedua';
        $payload['npwpPerwakilan'] = 'NPWP Kedua';
        $this->actingAs($secondUser)->postJson('/pengajuan/store', $payload)->assertOk()->assertJsonPath('icon', 'success');
        $this->assertSame(2, new_media_pengajuan::where('noKlbi', '58120, 60312')->count());
    }

    public function test_user_edits_are_visible_on_admin_verification_page(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->createActiveYear();
        $payload = $this->payload('nib.pdf');
        $this->actingAs($user)->postJson('/pengajuan/store', $payload)->assertOk();
        $record = new_media_pengajuan::where('id_user', $user->id)->firstOrFail();
        $payload['pengajuan_no'] = $record->pengajuan_no;
        $payload['namaPimprus'] = 'Pimpinan Baru';
        $payload['alamatKecPerusahaan'] = 'Kecamatan Baru';
        $this->actingAs($user)->putJson('/pengajuan/update', $payload)->assertOk()->assertJsonPath('icon', 'success');
        $this->assertDatabaseHas('new_media_pengajuans', ['pengajuan_no' => $record->pengajuan_no, 'namaPimprus' => 'pimpinan baru', 'alamatKecPerusahaan' => 'kecamatan baru']);
        $this->actingAs(User::factory()->create(['role' => 'admin']))->get('/pengajuan/verifikasi/'.$record->pengajuan_no)
            ->assertOk()->assertSee('name="namaPimprus" value="pimpinan baru"', false)
            ->assertSee('name="alamatKecPerusahaan" value="kecamatan baru"', false);
    }

    public function test_user_can_submit_a_kbli_code_outside_the_suggested_list(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->createActiveYear();
        $payload = $this->payload('nib.pdf');
        $payload['noKlbi'] = '58120, 99999';

        $this->actingAs($user)->postJson('/pengajuan/store', $payload)
            ->assertOk();

        $this->assertDatabaseHas('new_media_pengajuans', ['noKlbi' => '58120, 99999']);
    }

    public function test_company_fields_are_required_while_website_and_social_links_are_optional(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->createActiveYear();
        $payload = $this->payload('nib.pdf');
        unset($payload['namaMedia']);

        $this->actingAs($user)->postJson('/pengajuan/store', $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['namaMedia'])
            ->assertJsonMissingValidationErrors([
                'alamatWebsite', 'linkYoutube', 'linkFacebook', 'linkInstagram',
                'linkTiktok', 'linkThreads', 'linkX',
            ]);
    }

    public function test_selected_representative_fields_are_optional(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->createActiveYear();
        $payload = $this->payload('nib.pdf');
        unset(
            $payload['serfikatUkwPerwakilan'],
            $payload['alamatPerwakilan'],
            $payload['organisasiWartawan'],
            $payload['fileSerfikatUkwPerwakilan'],
            $payload['fileBuktiKeanggotaanOrganisasiWartawan'],
            $payload['organisasiPerusahaanPers'],
            $payload['fileBuktiKeanggotaanOrganisasiPerusahaanPers'],
        );

        $this->actingAs($user)->postJson('/pengajuan/store', $payload)
            ->assertOk()
            ->assertJsonPath('icon', 'success');
    }

    public function test_representative_npwp_is_required(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->createActiveYear();
        $payload = $this->payload('nib.pdf');
        unset($payload['npwpPerwakilan']);

        $this->actingAs($user)->postJson('/pengajuan/store', $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['npwpPerwakilan'])
            ->assertJsonPath('errors.npwpPerwakilan.0', 'NPWP Kepala Biro/Wartawan Perwakilan wajib diisi.');
    }

    public function test_editor_in_chief_and_company_leader_must_be_different(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->createActiveYear();
        $payload = $this->payload('nib.pdf');
        $payload['namaPimprus'] = $payload['namaPimred'];

        $this->actingAs($user)->postJson('/pengajuan/store', $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['namaPimred'])
            ->assertJsonPath('errors.namaPimred.0', 'Nama Pimpinan Redaksi tidak boleh sama dengan Nama Pimpinan Perusahaan.');
    }

    public function test_madya_competency_requires_a_statement_letter(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->createActiveYear();
        $payload = $this->payload('nib.pdf');
        $payload['jenisSerfikatUkwPimred'] = 'madya';
        unset($payload['fileSuratPernyataanPimred']);

        $this->actingAs($user)->postJson('/pengajuan/store', $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['fileSuratPernyataanPimred']);
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
            'noKlbi' => '58120, 60312',
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
            'jenisSerfikatUkwPerwakilan' => 'muda',
            'alamatPerwakilan' => 'Jalan Perwakilan 1',
            'alamatKecPerwakilan' => 'Tulang Bawang Tengah',
            'alamatKabPerwakilan' => 'Tulang Bawang Barat',
            'alamatProvPerwakilan' => 'Lampung',
            'npwpPerwakilan' => '12.345.678.9-012.000',
            'organisasiWartawan' => 'PWI',
            'organisasiPerusahaanPers' => 'JMSI',
            'fileNibPerusahaan' => $fileName,
            'fileKumhamPerusahaan' => 'ahu.pdf',
            'fileNpwpPerusahaan' => 'npwp.pdf',
            'fileSerfikatUkwPimred' => 'ukw-pimred.pdf',
            'fileSuratPernyataanPimred' => 'pernyataan.pdf',
            'fileSuratKeteranganWartawan' => 'keterangan-wartawan.pdf',
            'fileNpwpPerwakilan' => 'npwp-perwakilan.pdf',
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
