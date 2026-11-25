<?php

namespace Tests\Feature;

use App\Models\new_media_pengajuan;
use App\Support\PengajuanReview;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PengajuanReviewTest extends TestCase
{
    use RefreshDatabase;

    public function test_notes_page_renders_pending_fields_and_escaped_notes(): void
    {
        $this->actingAs(\App\Models\User::factory()->create(['role' => 'admin']));
        $record = new new_media_pengajuan();
        $record->pengajuan_no = 'TEST-NOTES';
        $record->jenis_media = 'siber';
        $record->namaMedia = 'Media Pengujian';
        $record->field_reviews = json_encode([
            'namaMedia' => ['verified' => false, 'note' => '<script>Catatan</script>'],
        ]);
        $html = view('admin.pengajuan.catatan', ['records' => collect([$record])])->render();
        $this->assertStringContainsString('Media Pengujian', $html);
        $this->assertStringContainsString('Belum terverifikasi', $html);
        $this->assertStringContainsString('&lt;script&gt;Catatan&lt;/script&gt;', $html);
        $this->assertStringContainsString('Export Excel', $html);
    }

    public function test_notes_page_renders_empty_list(): void
    {
        $this->actingAs(\App\Models\User::factory()->create(['role' => 'admin']));
        $html = view('admin.pengajuan.catatan', ['records' => collect()])->render();
        $this->assertStringContainsString('Tidak ada pengajuan yang belum diverifikasi.', $html);
    }

    public function test_verification_page_renders_valid_review_json(): void
    {
        $this->actingAs(\App\Models\User::factory()->create(['role' => 'admin']));
        $record = new new_media_pengajuan();
        $record->pengajuan_no = 'TEST-001';
        $record->jenis_media = 'siber';
        $record->namaMedia = 'Media </script> "Pengujian"';
        $html = view('admin.pengajuan.form_verify', [
            'media_data' => collect([$record]),
            'tahun_verifikasi' => 1,
        ])->render();

        preg_match('/<script type="application\/json" id="review-data">(.*?)<\/script>/s', $html, $matches);
        $this->assertNotEmpty($matches);
        $data = json_decode($matches[1], true, 512, JSON_THROW_ON_ERROR);
        $this->assertSame($record->namaMedia, $data['values']['namaMedia']);
        $this->assertTrue($data['editable']);
        $this->assertArrayHasKey('noKlbi', $data['fields']);
    }

    public function test_verification_displays_saved_leader_and_districts_even_with_old_input(): void
    {
        $this->actingAs(\App\Models\User::factory()->create(['role' => 'admin']));
        session()->flashInput(['namaPimprus' => '', 'alamatKecPerusahaan' => '', 'alamatKecPerwakilan' => '']);
        $record = new new_media_pengajuan();
        $record->pengajuan_no = 'TEST-VALUES';
        $record->jenis_media = 'siber';
        $record->namaPimprus = 'Pimpinan Contoh';
        $record->alamatKecPerusahaan = 'Kecamatan Perusahaan Contoh';
        $record->alamatKecPerwakilan = 'Kecamatan Perwakilan Contoh';
        $html = view('admin.pengajuan.form_verify', ['media_data' => collect([$record]), 'tahun_verifikasi' => 1])->render();
        $this->assertStringContainsString('name="namaPimprus" value="Pimpinan Contoh"', $html);
        $this->assertStringContainsString('name="alamatKecPerusahaan" value="Kecamatan Perusahaan Contoh"', $html);
        $this->assertStringContainsString('name="alamatKecPerwakilan" value="Kecamatan Perwakilan Contoh"', $html);
    }

    public function test_required_fields_follow_media_and_competency(): void
    {
        $record = new new_media_pengajuan();
        $record->jenis_media = 'siber';
        $this->assertArrayNotHasKey('izinIpp', PengajuanReview::fields($record));
        $this->assertArrayNotHasKey('alamatWebsite', PengajuanReview::fields($record));
        $record->jenis_media = 'elektronik';
        $record->jenisSerfikatUkwPimred = 'madya';
        $this->assertArrayHasKey('fileIzinIpp', PengajuanReview::fields($record));
        $this->assertArrayHasKey('fileSuratPernyataanPimred', PengajuanReview::fields($record));
    }

    public function test_acceptance_requires_all_checks_and_changed_values_invalidate_checks(): void
    {
        $record = new new_media_pengajuan();
        $record->jenis_media = 'siber';
        $this->assertFalse(PengajuanReview::complete($record));
        $reviews = [];
        foreach (PengajuanReview::fields($record) as $key => $label) {
            $record->$key = 'Test value';
            $reviews[$key] = ['verified' => true, 'value' => 'Test value'];
        }
        $record->field_reviews = json_encode($reviews);
        $this->assertTrue(PengajuanReview::complete($record));
        $record->namaMedia = 'Changed';
        $this->assertFalse(PengajuanReview::complete($record));
    }
}
