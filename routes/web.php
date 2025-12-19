<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaundryController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\Petugas\PetugasLaundryController;
use App\Http\Controllers\Petugas\PetugasLayananController;
use App\Http\Controllers\Petugas\PetugasPelangganController;
use App\Http\Controllers\MemberController;

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Route;

Route::get('/member/history', [laundryController::class, 'history'])->name('member.history');

//login dan logout
Route :: get ('/', [LaundryController::class,'index'])->name('member.member');
Route :: get ('/login', [AuthController::class,'login'])->name('login');
Route :: post ('/login', [AuthController::class,'autheticate'])->name('login.proses');
Route :: get('/logout', [AuthController::class, 'logout'])->name('logout');
Route :: get('/dashboard', [AuthController::class,'dashboard'])->name('dashboard');
Route ::get('/petugas/dashboard', [AuthController::class, 'petugasdashboard'])->name('petugas.dashboard');

//laundry crud
Route :: get('/laundry', [LaundryController::class,'laundry'])->name('laundry');
Route :: get ('/laundry/create', [LaundryController::class,'create'])->name('laundry.create');
Route :: post ('/laundry/store', [LaundryController::class,'store'])->name('laundry.store');
Route :: get ('/laundry/edit/{id}', [LaundryController::class,'edit'])->name('laundry.edit');
Route :: put ('/laundry/update/{id}', [LaundryController::class,'update'])->name('laundry.update');
// Route untuk cetak struk
Route::get('/laundry/cetak/{id}', [LaundryController::class, 'cetakStruk'])->name('laundry.cetak');
// Route update status laundry
Route::put('/laundry/update-status/{id}', [LaundryController::class,'updateStatus'])->name('laundry.updateStatus');
Route::get('/laundry/export', [LaundryController::class, 'exportLaporan'])->name('laundry.export');

//layanan crud
Route :: get('/layanan', [LayananController::class, 'layanan'])->name('layanan');
Route :: get ('/layanan/create', [LayananController::class,'create'])->name('layanan.create');
Route :: post ('/layanan/store', [LayananController::class,'store'])->name('layanan.store');
Route :: get ('/layanan/edit/{id}', [LayananController::class,'edit'])->name('layanan.edit');
Route :: put ('/layanan/update/{id}', [LayananController::class,'update'])->name('layanan.update');
Route :: delete ('/layanan/delete/{id}', [LayananController::class,'delete'])->name('layanan.delete'); 

//pelanggan crud
Route :: get('/pelanggan', [PelangganController::class, 'pelanggan'])->name('pelanggan');
Route :: get ('/pelanggan/create', [PelangganController::class,'create'])->name('pelanggan.create');
Route :: post ('/pelanggan/store', [PelangganController::class,'store'])->name('pelanggan.store');
Route :: get ('/pelanggan/edit/{id}', [PelangganController::class,'edit'])->name('pelanggan.edit');
Route :: put ('/pelanggan/update/{id}', [PelangganController::class,'update'])->name('pelanggan.update');
Route :: delete ('/pelanggan/delete/{id}', [PelangganController::class,'delete'])->name('pelanggan.delete');
Route :: get('/pelanggan/export', [PelangganController::class, 'exportLaporan'])->name('pelanggan.export');

//admin crud
Route :: get('/user', [AdminController::class, 'user'])->name('user');
Route :: get ('/admin/create', [AdminController::class,'create'])->name('admin.create');
Route :: post ('/admin/store', [AdminController::class,'store'])->name('admin.store');
Route :: get ('/admin/edit/{id}', [AdminController::class,'edit'])->name('admin.edit');
Route :: put ('/admin/update/{id}', [AdminController::class,'update'])->name('admin.update');
Route :: delete ('/admin/delete/{id}', [AdminController::class,'delete'])->name('admin.delete'); 


// ==================== PETUGAS ====================

// Laundry
Route::get('/petugas/laundry', [PetugasLaundryController::class,'laundry'])->name('petugas.laundry');
Route::get('/petugas/laundry/create', [PetugasLaundryController::class,'create'])->name('petugas.laundry.create');
Route::post('/petugas/laundry/store', [PetugasLaundryController::class,'store'])->name('petugas.laundry.store');
Route::get('/petugas/laundry/edit/{id}', [PetugasLaundryController::class,'edit'])->name('petugas.laundry.edit');
Route::put('/petugas/laundry/update/{id}', [PetugasLaundryController::class,'update'])->name('petugas.laundry.update');
Route::get('/petugas/laundry/cetak/{id}', [PetugasLaundryController::class,'cetakStruk'])->name('petugas.laundry.cetak');
Route::put('/petugas/laundry/update-status/{id}', [PetugasLaundryController::class,'updateStatus'])->name('petugas.laundry.updateStatus');
Route::get('/petugas/laundry/export', [PetugasLaundryController::class,'exportLaporan'])->name('petugas.laundry.export');

// Layanan
Route::get('/petugas/layanan', [PetugasLayananController::class,'layanan'])->name('petugas.layanan');
Route::get('/petugas/layanan/create', [PetugasLayananController::class,'create'])->name('petugas.layanan.create');
Route::post('/petugas/layanan/store', [PetugasLayananController::class,'store'])->name('petugas.layanan.store');
Route::get('/petugas/layanan/edit/{id}', [PetugasLayananController::class,'edit'])->name('petugas.layanan.edit');
Route::put('/petugas/layanan/update/{id}', [PetugasLayananController::class,'update'])->name('petugas.layanan.update');
Route::delete('/petugas/layanan/delete/{id}', [PetugasLayananController::class,'delete'])->name('petugas.layanan.delete');

// Pelanggan
Route::get('/petugas/pelanggan', [PetugasPelangganController::class,'pelanggan'])->name('petugas.pelanggan');
Route::get('/petugas/pelanggan/create', [PetugasPelangganController::class,'create'])->name('petugas.pelanggan.create');
Route::post('/petugas/pelanggan/store', [PetugasPelangganController::class,'store'])->name('petugas.pelanggan.store');
Route::get('/petugas/pelanggan/edit/{id}', [PetugasPelangganController::class,'edit'])->name('petugas.pelanggan.edit');
Route::put('/petugas/pelanggan/update/{id}', [PetugasPelangganController::class,'update'])->name('petugas.pelanggan.update');
Route::delete('/petugas/pelanggan/delete/{id}', [PetugasPelangganController::class,'delete'])->name('petugas.pelanggan.delete');

