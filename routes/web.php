<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaundryController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PelangganController;
use Illuminate\Support\Facades\Route;

//login dan logout
Route :: get ('/', [AuthController::class,'index'])->name('login');
Route :: post ('/', [AuthController::class,'autheticate'])->name('login.proses');
Route :: get('/logout', [AuthController::class, 'logout'])->name('logout');

//laundry crud
Route :: get('/laundry', [LaundryController::class,'laundry'])->name('laundry');
Route :: get ('/laundry/create', [LaundryController::class,'create'])->name('laundry.create');
Route :: post ('/laundry/store', [LaundryController::class,'store'])->name('laundry.store');
Route :: get ('/laundry/edit/{id}', [LaundryController::class,'edit'])->name('laundry.edit');
Route :: put ('/laundry/update/{id}', [LaundryController::class,'update'])->name('laundry.update');

//layanan crud
Route :: get('/layanan', [LayananController::class, 'layanan'])->name('layanan');
Route :: get ('/layanan/create', [LayananController::class,'create'])->name('layanan.create');
Route :: post ('/layanan/store', [LayananController::class,'store'])->name('layanan.store');
Route :: get ('/layanan/edit/{id}', [LayananController::class,'edit'])->name('layanan.edit');
Route :: put ('/layanan/update/{id}', [LayananController::class,'update'])->name('layanan.update');
Route :: delete ('/layanan/delete/{id}', [LayananController::class,'delete'])->name('layanan.delete'); 

//pelanggan crud
Route :: get('/pelanggan', [PelangganController::class, 'pelanggan'])->name('pelanggan');
Route :: get ('/create', [PelangganController::class,'create'])->name('pelanggan.create');
Route :: post ('/store', [PelangganController::class,'store'])->name('pelanggan.store');
Route :: get ('edit/{id}', [PelangganController::class,'edit'])->name('pelanggan.edit');
Route :: put ('update/{id}', [PelangganController::class,'update'])->name('pelanggan.update');
Route :: delete ('delete/{id}', [PelangganController::class,'delete'])->name('pelanggan.delete'); 

