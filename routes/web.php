<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\McuDokterController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedicalCheckUpController;
use App\Http\Controllers\RekammedisController;
use App\Http\Controllers\UserController;
use App\Models\RekamMedis;
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

// login
route::get('/login',[LoginController::class,'index'])->name('login');
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
// user
// route::get('/user',[UserController::class, 'index'])->name('user.index');
Route::resource('/user', UserController::class);
route::get('/get-users',[UserController::class, 'getUsers'])->name('get.users');
// Route::get('/employee', [EmployeeController::class, 'index']);

// mcu
Route::get('/mcu/json', "MedicalCheckUpController@json");
Route::post('/mcu', [MedicalCheckUpController::class, 'store'])->name('mcu.store');
Route::get('/mcu', [MedicalCheckUpController::class, 'index'])->name('mcu.index');
Route::get('/mcu/create', [MedicalCheckUpController::class, 'create'])->name('mcu.create');
Route::get('/rekapan', [MedicalCheckUpController::class, 'rekapan'])->name('rekapan');
Route::get('/rekapan/show', [MedicalCheckUpController::class, 'showRekapan'])->name('rekapan.show');
Route::put('/mcu/updateInline/{id}', [MedicalCheckUpController::class, 'updateInline'])->name('mcu.updateInline');
Route::put('/mcu/saveInlineEdit/{id}', [MedicalCheckUpController::class, 'saveInlineEdit'])->name('mcu.saveInlineEdit');
Route::put('/mcu/update/{user}', [MedicalCheckUpController::class,'update'])->name('mcu.update');

// edit
// Route::get('/mcu/edit/{id}', [MedicalCheckUpController::class, 'edit'])->name('mcu.edit');
// Route::put('/mcu/update/{id}', [MedicalCheckUpController::class, 'update'])->name('mcu.update');
Route::get('/mcu/{user}/edit/{tahun}', [MedicalCheckUpController::class,'edit'])->name('mcu.edit');

// Hapus Data
Route::delete('/mcu/{id}/{tahun}', [MedicalCheckUpController::class, 'destroy'])->name('mcu.destroy');


// cetak
// Route::get('/mcu/pdf', [MedicalCheckUpController::class,'generatePDF'])->name('medicalcheckup.pdf');
Route::get('/mcu/print/{id}/{tahun}', [MedicalCheckUpController::class,'print'])->name('mcu.print');

// SumaryMCU
Route::get('/mcu/sumarymcu', [MedicalCheckUpController::class, 'sumarymcu'])->name('mcu.sumarymcu');


// Rekam Medis
route::get('/rekammedis',[RekammedisController::class,'index'])->name('rekammedis.rekammedis');
Route::get('/rekammedis/create', [RekammedisController::class, 'create'])->name('rekammedis.create');
Route::post('/rekammedis/store', [RekammedisController::class, 'store'])->name('rekammedis.store');
Route::get('/rekapanrekammedis', [RekammedisController::class, 'rekapan'])->name('rekapanrekammedis');
Route::get('/rekapanrekammedis/show', [RekammedisController::class, 'showRekapan'])->name('rekapanrekammedis.show');
// jumlah berobat
Route::get('/rekammedis/jumlahberobat', [RekammedisController::class, 'jumlahberobat'])->name('rekammedis.jumlahberobat');
// rekam medis non karyawan
Route::get('/rekammedis/nonkaryawan', [RekammedisController::class, 'tampilnonkaryawan'])->name('rekammedis.nonkaryawan');
// jenis penyakit
Route::get('/rekammedis/jenispenyakit', [RekammedisController::class, 'jenispenyakit'])->name('rekammedis.jenispenyakit');

// Dokter 
Route::get('/mcudokter', [McuDokterController::class, 'index'])->name('mcudokter.index');
Route::get('/mcudokter/create', [McuDokterController::class, 'create'])->name('mcudokter.create');
Route::post('/mcudokter/store', [McuDokterController::class, 'store'])->name('mcudokter.store');
// edit
Route::put('/mcudokter/update/{user}', [McuDokterController::class,'update'])->name('mcudokter.update');
Route::get('/mcudokter/{user}/edit/{tahun}', [McuDokterController::class,'edit'])->name('mcudokter.edit');
// print
Route::get('/mcudokter/print/{id}/{year}', [McuDokterController::class, 'print'])->name('mcudokter.print');

 

