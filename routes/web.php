<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\BuktiTayangController;
use App\Http\Controllers\CobarizkiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MediaDaftarController;
use App\Http\Controllers\MediaJenisController;
use App\Http\Controllers\MediaPengajuanController;
use App\Http\Controllers\MediaPengajuanDaftarController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard-peng');
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    /**
     * pengajuan
     */
    Route::prefix('/pengajuan',)->group(function () {
        Route::get('/index', [MediaPengajuanController::class, 'index']);
        Route::get('/create', [MediaPengajuanController::class, 'create']);
        Route::get('/show/{jenis}', [MediaPengajuanController::class, 'show']);
        Route::post('/store', [MediaPengajuanController::class, 'store']);
        Route::get('/checkurl', [MediaPengajuanController::class, 'check_url']);
        Route::post('/uploads', [MediaPengajuanController::class, 'upload_data']);
        Route::get('/edit/{no_pengajuan}', [MediaPengajuanController::class, 'edit'])->name('pengajuan.edit');
        Route::get('/cek_data/{no_pengajuan}', [MediaPengajuanController::class, 'show_data'])->name('pengajuan.cek_data');
        Route::put('/update', [MediaPengajuanController::class, 'update'])->name('pengajuan.update');
        Route::POST('/create', [MediaPengajuanController::class, 'create'])->name('pengajuan.create');
    });
    // admin
    Route::group(['prefix' => 'pengajuan', 'middleware' => ['role:admin']], function () {
        Route::get('/verifikasi/{no_pengajuan}', [MediaPengajuanController::class, 'show_data'])->name('pengajuan.show_data');
        Route::put('/verifikasi', [MediaPengajuanController::class, 'verifikasi'])->name('verifikasi.put');
        Route::post('/verifikasi', [MediaPengajuanController::class, 'verifikasi'])->name('verifikasi.post');
    });

    Route::prefix('/daftar')->group(function () {
        // Route::get('/', [MediaPengajuanDaftarController::class, 'show_detail']);

        Route::get('/', [MediaPengajuanDaftarController::class, 'index']);
        Route::get('/show', [MediaPengajuanDaftarController::class, 'show']);
        Route::get('/{tahun}/detail', [MediaPengajuanDaftarController::class, 'index_detail']);
        Route::get('/{tahun}/show', [MediaPengajuanDaftarController::class, 'show_detail'])->name('daftar.show');
    });
    // end of Pengajuan

    /**
     * Paket
     */
    Route::prefix('/paket')->group(function () {
        // admin
        Route::middleware(['role:admin'])->group(function () {
            Route::get('/', [PaketController::class, 'index']);
            Route::get('/show', [PaketController::class, 'show']);
            Route::get('/create', [PaketController::class, 'create']);
            Route::POST('/store', [PaketController::class, 'store']);
            Route::get('/detail/{id}', [PaketController::class, 'index_detail']);
            Route::get('/show_detail/{id}', [PaketController::class, 'show_detail']);
            Route::get('/create_detail/{id}', [PaketController::class, 'create_detail']);
            Route::POST('/store_detail', [PaketController::class, 'store_detail'])->name('paket.store_detail');
            Route::POST('/destroy_detail', [PaketController::class, 'destroy_detail']);
        });

        Route::middleware(['role:user'])->group(function () {
            // Route::get('/', [PaketController::class, 'index']);
        });
    });
    //  end of paket

    /**
     * Budget
     */
    Route::prefix('/budget')->group(function () {
        // admin
        Route::middleware(['role:admin'])->group(function () {
            Route::get('/', [BudgetController::class, 'index']);
            Route::get('/show', [BudgetController::class, 'show']);
            Route::get('/edit/{budget}', [BudgetController::class, 'edit']);
            Route::post('/update', [BudgetController::class, 'update']);
        });

        Route::middleware(['role:user'])->group(function () {
            // Route::get('/', [PaketController::class, 'index']);
        });
    });
    //  end of budget

    /**
     * order
     */
    Route::prefix('/order')->group(function () {

        Route::middleware(['role:admin|operator|user'])->group(function () {
            Route::get('/print/{no_order}', [OrderController::class, 'print']);
        });

        // admin
        Route::middleware(['role:admin|operator'])->group(function () {
            Route::get('/daftar', [OrderController::class, 'index_tahun']);
            Route::get('/show_tahun', [OrderController::class, 'show_tahun']);
            Route::get('/{tahun}', [OrderController::class, 'index'])->whereNumber('tahun');
            Route::get('/{tahun}/show', [OrderController::class, 'show'])->whereNumber('tahun');
            Route::post('/update', [OrderController::class, 'update']);
        });

        Route::middleware(['role:admin'])->group(function () {
            Route::get('/create', [OrderController::class, 'create']);
            Route::get('/data_media', [OrderController::class, 'get_data_media']);
            Route::get('/data_paket', [OrderController::class, 'get_data_paket']);
            Route::post('/store', [OrderController::class, 'store']);
        });

        Route::middleware(['role:user'])->group(function () {
            // Route::get('/', [PaketController::class, 'index']);
        });
    });
    //  end of order

    /**
     * bukti tayang
     */
    Route::prefix('/bukti_tayang')->group(function () {

        Route::middleware(['role:admin|operator'])->group(function () {
        });

        Route::middleware(['role:admin|user'])->group(function () {
            Route::get('/', [BuktiTayangController::class, 'index']);
            Route::POST('/store', [BuktiTayangController::class, 'store']);
            Route::get('/show', [BuktiTayangController::class, 'show']);
            Route::get('/{tahun}/detail', [BuktiTayangController::class, 'index_detail'])->whereNumber('tahun');
            Route::get('/{tahun}/show', [BuktiTayangController::class, 'show_detail'])->whereNumber('tahun');
            Route::get('/create', [BuktiTayangController::class, 'create']);
        });

        // admin
        Route::middleware(['role:admin'])->group(function () {
            Route::post('/update', [BuktiTayangController::class, 'update']);
            Route::get('/print/{no_order}', [BuktiTayangController::class, 'print']);
        });

        Route::middleware(['role:user'])->group(function () {
            Route::get('/{tahun}/create/{nomor}', [BuktiTayangController::class, 'create_input'])->whereNumber('tahun');
        });
    });
    //  end of budget
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__ . '/auth.php';
