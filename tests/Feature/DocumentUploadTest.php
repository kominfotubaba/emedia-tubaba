<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class DocumentUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_uploaded_filename_matches_disk_and_document_can_be_opened(): void
    {
        $originalPublicPath = $this->app->make('path.public');
        $publicPath = sys_get_temp_dir().'/emedia-document-test-'.bin2hex(random_bytes(8));
        File::ensureDirectoryExists($publicPath);
        $this->app->instance('path.public', $publicPath);

        try {
            $response = $this->actingAs(User::factory()->create(['role' => 'user']))->post('/pengajuan/uploads', [
                'data' => 'fileNpwpPerwakilan',
                'file' => UploadedFile::fake()->create('npwp.pdf', 10, 'application/pdf'),
            ])->assertOk();

            $name = $response->json('name');
            $this->assertSame(strtolower($name), $name);
            $this->assertFileExists($publicPath.'/tmp/uploads/filenpwpperwakilan/'.$name);
            $this->get('/dokumen/filenpwpperwakilan/'.$name)->assertOk();
            $this->get('/dokumen/filenpwpperwakilan/'.strtoupper($name))->assertOk();
            $this->get('/dokumen/fileserfikatukwpimred/missing.pdf')->assertNotFound();
        } finally {
            $this->app->instance('path.public', $originalPublicPath);
            File::deleteDirectory($publicPath);
        }
    }
}
