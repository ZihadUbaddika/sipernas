<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\Dashboard\Inspektur\InspektursController;
use App\Http\Controllers\Dashboard\Irban\IrbansController;
use App\Http\Controllers\Dashboard\Pegawai\PengajuansController;
use App\Http\Controllers\Dashboard\Pegawai\ProgramKegiatansController;
use App\Http\Controllers\Dashboard\Pegawai\SptsController;
use App\Http\Controllers\Dashboard\PPTK\PptksController;
use App\Http\Controllers\UsersManagement\KepegawaiansController;
use App\Http\Controllers\UsersManagement\PermissionsController;
use App\Http\Controllers\UsersManagement\RolesController;
use App\Http\Controllers\UsersManagement\UsersController;

Route::get('/', function () {
    return view('landing.homepage');
});

Route::get('/tupoksi', function () {
    return view('landing.tupoksi');
});

Route::get('/struktur', [HomepageController::class, 'index']);

Route::redirect('/home', '/dashboard');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/profile/{id}', [HomeController::class, 'profile_saya'])->name('profile_saya');
        Route::group(['prefix' => 'users_management', 'as' => 'users_management.'], function () {
            //Permission
            Route::delete('permissions/destroy', [PermissionsController::class, 'massDestroy'])->name('permissions.massDestroy');
            Route::resource('permissions', PermissionsController::class);
            //Roles
            Route::delete('roles/destroy', [RolesController::class, 'massDestroy'])->name('roles.massDestroy');
            Route::resource('roles', RolesController::class);
            //Users
            Route::delete('users/destroy', [UsersController::class, 'massDestroy'])->name('users.massDestroy');
            Route::resource('users', UsersController::class);
            //Kepegawaian
            Route::delete('kepegawaians/destroy', [KepegawaiansController::class, 'massDestroy'])->name('kepegawaians.massDestroy');
            Route::resource('kepegawaians', KepegawaiansController::class);
        });
    });
    Route::group(['prefix' => 'inspektur', 'as' => 'inspektur.'], function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('pengajuans', [InspektursController::class, 'index'])->name('pengajuans.index');
        Route::get('pengajuans/show/{id}', [InspektursController::class, 'show'])->name('pengajuans.show');
        Route::put('pengajuans/{id}/submit', [InspektursController::class, 'submit'])->name('pengajuans.submit');
        Route::post('pengajuans/cetak_notadinas/{id}', [InspektursController::class, 'cetak_notadinas'])->name('pengajuans.cetak_notadinas');
        Route::delete('pengajuans/destroy', [InspektursController::class, 'massdestroy'])->name('pengajuans.massDestroy');
        Route::get('spts', [InspektursController::class, 'spts'])->name('spts.index');
        Route::post('spts/cetak_spt/{id}', [InspektursController::class, 'cetak_spt'])->name('spts.cetak_spt');
        Route::get('programkegiatans', [InspektursController::class, 'programkegiatan'])->name('programkegiatans.index');
        Route::get('programkegiatans/show/{id}', [InspektursController::class, 'showprogramkegiatan'])->name('programkegiatans.show');
        Route::patch('programkegiatans/downloadlhp/{id}', [InspektursController::class, 'download_lhp'])->name('programkegiatans.download_lhp');
        Route::get('riwayatkegiatans', [InspektursController::class, 'riwayat'])->name('riwayatkegiatans.index');
    });
    Route::group(['prefix' => 'irban', 'as' => 'irban.'], function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('pengajuans', [IrbansController::class, 'index'])->name('pengajuans.index');
        Route::get('pengajuans/show/{id}', [IrbansController::class, 'show'])->name('pengajuans.show');
        Route::put('pengajuans/{id}/submit', [IrbansController::class, 'submit'])->name('pengajuans.submit');
        Route::post('pengajuans/cetak_notadinas/{id}', [IrbansController::class, 'cetak_notadinas'])->name('pengajuans.cetak_notadinas');
        Route::delete('pengajuans/destroy', [IrbansController::class, 'massdestroy'])->name('pengajuans.massDestroy');
        Route::get('spts', [IrbansController::class, 'spts'])->name('spts.index');
        Route::post('spts/cetak_spt/{id}', [IrbansController::class, 'cetak_spt'])->name('spts.cetak_spt');
        Route::get('programkegiatans', [IrbansController::class, 'programkegiatan'])->name('programkegiatans.index');
        Route::get('programkegiatans/show/{id}', [IrbansController::class, 'showprogramkegiatan'])->name('programkegiatans.show');
        Route::patch('programkegiatans/downloadlhp/{id}', [IrbansController::class, 'download_lhp'])->name('programkegiatans.download_lhp');
        Route::get('riwayatkegiatans', [IrbansController::class, 'riwayat'])->name('riwayatkegiatans.index');

    });
    Route::group(['prefix' => 'pptk', 'as' => 'pptk.'], function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::redirect('spts', 'spts_tertunda');
        Route::get('spts_terbit', [PptksController::class, 'spt_terbit'])->name('spts.spt_terbit');
        Route::get('spts_tertunda', [PptksController::class, 'spt_tertunda'])->name('spts.spt_tertunda');
        Route::get('spts/create/{id}', [PptksController::class, 'create'])->name('spts.create');
        Route::put('spts/store/{id}', [PptksController::class, 'store'])->name('spts.store');
        Route::post('spts/cetak_spt/{id}', [PptksController::class, 'cetak_spt'])->name('spts.cetak_spt');
    });
    Route::group(['prefix' => 'pegawai', 'as' => 'pegawai.'], function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::resource('pengajuans', PengajuansController::class);
        Route::put('pengajuans/{id}/submit', [PengajuansController::class, 'submit'])->name('pengajuans.submit');
        Route::post('pengajuans/cetak_notadinas/{id}', [PengajuansController::class, 'cetak_notadinas'])->name('pengajuans.cetak_notadinas');
        Route::delete('pengajuans/destroy', [PengajuansController::class, 'massdestroy'])->name('pengajuans.massDestroy');
        Route::get('spts', [SptsController::class, 'index'])->name('spts.index');
        Route::post('spts/cetak_spt/{id}', [SptsController::class, 'cetak_spt'])->name('spts.cetak_spt');
        Route::get('programkegiatans', [ProgramKegiatansController::class, 'index'])->name('programkegiatans.index');
        Route::get('programkegiatans/show/{id}', [ProgramKegiatansController::class, 'show'])->name('programkegiatans.show');
        Route::get('programkegiatans/uploadlhp/{id}', [ProgramKegiatansController::class, 'upload_lhp'])->name('programkegiatans.upload_lhp');
        Route::put('programkegiatans/storelhp/{id}', [ProgramKegiatansController::class, 'store_lhp'])->name('programkegiatans.store_lhp');
        Route::patch('programkegiatans/downloadlhp/{id}', [ProgramKegiatansController::class, 'download_lhp'])->name('programkegiatans.download_lhp');
        Route::get('riwayatkegiatans', [ProgramKegiatansController::class, 'riwayat'])->name('riwayatkegiatans.index');
    });
});
