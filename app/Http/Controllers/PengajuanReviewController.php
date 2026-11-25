<?php

namespace App\Http\Controllers;

use App\Models\new_media_pengajuan;
use App\Models\tahun;
use App\Support\PengajuanReview;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class PengajuanReviewController extends Controller
{
    public function save(Request $request, $no)
    {
        abort_unless(tahun::where('verifikasi', 1)->exists(), 403, 'Periode verifikasi belum dibuka.');
        $record = new_media_pengajuan::where('pengajuan_no', $no)->firstOrFail();
        $data = $request->validate([
            'reviews' => ['required', 'array'],
            'reviews.*.verified' => ['required', 'boolean'],
            'reviews.*.note' => ['nullable', 'string', 'max:2000'],
        ]);
        $reviews = [];
        foreach (PengajuanReview::fields($record) as $key => $label) {
            $item = $data['reviews'][$key] ?? [];
            $reviews[$key] = [
                'verified' => !empty($item['verified']) && filled($record->$key),
                'note' => $item['note'] ?? '',
                'value' => (string) $record->$key,
                'admin_id' => $request->user()->id,
                'reviewed_at' => now()->toIso8601String(),
            ];
        }
        $record->field_reviews = json_encode($reviews);
        $record->save();
        return response()->json(['message' => 'Checklist dan catatan berhasil disimpan.']);
    }

    public function index(Request $request)
    {
        $records = new_media_pengajuan::whereIn('status', ['ajukan', 'edit', 'tolak'])
            ->orderByDesc('tahun_pengajuan')->orderBy('namaMedia')->get();
        if ($request->boolean('export')) {
            $sheet = new Spreadsheet();
            $active = $sheet->getActiveSheet();
            $rows = [['Nomor Pengajuan', 'Tahun', 'Media', 'Jenis Media', 'Field', 'Status Verifikasi', 'Catatan']];
            foreach ($records as $record) {
                $reviews = PengajuanReview::reviews($record);
                foreach (PengajuanReview::fields($record) as $key => $label) {
                    $item = $reviews[$key] ?? [];
                    $verified = !empty($item['verified']) && ($item['value'] ?? null) === (string) $record->$key;
                    if ($verified && empty($item['note'])) continue;
                    $rows[] = [$record->pengajuan_no, $record->tahun_pengajuan, $record->namaMedia, $record->jenis_media, $label, $verified ? 'Terverifikasi' : 'Belum terverifikasi', $item['note'] ?? ''];
                }
            }
            foreach ($rows as $i => $row) {
                foreach ($row as $j => $value) {
                    $active->setCellValueExplicitByColumnAndRow($j + 1, $i + 1, (string) $value, DataType::TYPE_STRING);
                }
            }
            return response()->streamDownload(function () use ($sheet) {
                (new Xlsx($sheet))->save('php://output');
            }, 'daftar-media-dengan-catatan.xlsx', ['Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']);
        }
        return view('admin.pengajuan.catatan', ['records' => $records]);
    }
}
