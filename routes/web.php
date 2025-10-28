<?php

use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\LaporanController;
use App\Models\Booking;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Auth;
// Route::get('/admin', function () {
//     return view('admin/dashboard');
// })->name('admin.dashboard');



Route::middleware(['guest'])->group(function () {
    Route::get('/login-krebet', [AdminController::class, 'login'])->name('login');
    Route::post('/login-proses-krebet', [AdminController::class, 'loginProses'])->name('admin.login.proses');
});


// Route::get('/admin/invoice{id}', [PDFController::class, 'invoice'])->name('user.invoice');
// Route::get('/admin/invoice{id}?output=pdf', [PDFController::class, 'invoice'])->name('user.invoice.pdf');
Route::get('/admin/invoice{id}', [PDFController::class, 'invoice'])->name('admin.invoice');
Route::get('/admin/invoice{id}?output=pdf', [PDFController::class, 'invoice'])->name('admin.invoice.pdf');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout-krebet', [AdminController::class, 'logout'])->name('admin.logout');
    Route::middleware(['role:Sekretaris'])->group(function () {
        Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');
        Route::get('/laporan/search', [AdminController::class, 'laporanSearch'])->name('admin.laporan.search');

        Route::get('/laporan/report', [PDFController::class, 'laporan'])->name('admin.laporan.print');
        Route::get('/laporan/report/pdf', [PDFController::class, 'laporan_pdf'])->name('admin.laporan.pdf');

        Route::get('/admin/kalender', [AdminController::class, 'index'])->name('admin.kalender');
        Route::get('/admin-booking-proses', [AdminController::class, 'store'])->name('admin.bookingProses');

        Route::get('/admin/booking', [AdminController::class, 'show'])->name('admin.booking');
        Route::get('/admin/booking/search-pic', [AdminController::class, 'searchPIC'])->name('admin.booking.pic.search');
        Route::get('/admin/detail/{id}', [AdminController::class, 'detail'])->name('admin.detail');
        Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit.booking');
        Route::post('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.bookingUpdate');
        Route::get('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.booking.delete');

        Route::get('/paket/manajemen', [PaketController::class, 'index'])->name('admin.paket.index');
        Route::post('/admin/paket/update/{model}/{id}', [PaketController::class, 'update'])->name('admin.paket.update');

    });

    // Keuangan Admin
    Route::middleware(['role:Bendahara'])->group(function () {
        Route::get('/keuangan', [KeuanganController::class, 'index'])->name('admin.keuangan.index');

        // Pemasukan
        Route::get('/pemasukan', [KeuanganController::class, 'pemasukan'])->name('admin.keuangan.pemasukan');
        Route::get('/pemasukan/create', [KeuanganController::class, 'createPemasukan'])->name('admin.keuangan.pemasukan.create');
        Route::post('/pemasukan/store', [KeuanganController::class, 'storePemasukan'])->name('admin.keuangan.pemasukan.store');

        // Pengeluaran
        Route::get('/pengeluaran', [KeuanganController::class, 'pengeluaran'])->name('admin.keuangan.pengeluaran');
        Route::get('/pengeluaran/create', [KeuanganController::class, 'createPengeluaran'])->name('admin.keuangan.pengeluaran.create');
        Route::post('/pengeluaran/store', [KeuanganController::class, 'storePengeluaran'])->name('admin.keuangan.pengeluaran.store');


        // Laporan
        Route::resource('laporan-keuangan', LaporanController::class)->names('admin.laporan');
        Route::post('/laporan-keuangan/{id}/approve', [LaporanController::class, 'approve'])->name('admin.laporan.approve');
        Route::post('/laporan-keuangan/{id}/reject', [LaporanController::class, 'reject'])->name('admin.laporan.reject');


    });
    Route::middleware(['role:Bendahara Lapangan'])->group(function () {
        Route::get('/guide', [GuideController::class, 'index'])->name('admin.guide.index');
        Route::get('/guide/create/{id}', [GuideController::class, 'create'])->name('admin.guide.create');
        Route::post('/guide/store/{id}', [GuideController::class, 'store'])->name('admin.guide.store');
    });

    Route::middleware(['role:Bendahara Lapangan|Bendahara'])->group(function () {
        // Laporan
        Route::resource('laporan-keuangan', LaporanController::class)->names('admin.laporan');
        Route::get('/kas/export/{id}', [LaporanController::class, 'exportExcel'])->name('kas.export');

        // Route::post('/laporan-keuangan/{id}/approve', [LaporanController::class, 'approve'])->name('admin.laporan.approve');

    });
    // Data
    Route::get('/booking-detail/{id}', [KeuanganController::class, 'getDetail']);
    Route::get('/admin/invoice/{id}/send', [PDFController::class, 'send'])->name('admin.invoice.send');

});
Route::get('/testing', function () {
    return view('calendar');
})->name('admin.test');

Route::get('/form', function () {
    return view('form');
})->name('admin.form');

Route::get('/', [LandingPageController::class, 'index'])->name('user.landingpage');
Route::get('/booking/proses', [LandingPageController::class, 'store'])->name('user.bookingProses');


