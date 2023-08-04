<?php

use App\Http\Controllers\Admin\AlternativeController;
use App\Http\Controllers\Admin\CriteriaController;
use App\Http\Controllers\Admin\CriteriaPerbandinganController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RankingController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PortalController;
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

Route::get('/',  [PortalController::class, 'index'])->name('portal.index');

Route::get('/login',  [LoginController::class, 'index'])->middleware('guest')->name('login.index');
Route::post('/login',  [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('dashboard')
    // ->namespace('Admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard.index');
        Route::resources([
            'kriteria'      => CriteriaController::class,
            'student'       => StudentController::class,
            'student/kelas' => KelasController::class,
            'users'         => UserController::class,
        ], ['except' => 'show', 'middleware' => 'admin']);
        // alternatif
        Route::resource('alternatif', AlternativeController::class)
            ->except('show');
        // profile
        Route::get('profile', [ProfileController::class, 'index'])
            ->name('profile.index');
        Route::put('profile/{users}', [ProfileController::class, 'update'])
            ->name('profile.update');
        // link slug
        Route::get('student/kelas/{kelas:slug}', [KelasController::class, 'students'])
            ->name('kelas.students');
        // perbandingan
        Route::get('perbandingan', [CriteriaPerbandinganController::class, 'index'])
            ->name('perbandingan.index');
        Route::post('perbandingan', [CriteriaPerbandinganController::class, 'store'])
            ->name('perbandingan.store');
        Route::get('perbandingan/{criteria_analysis}', [CriteriaPerbandinganController::class, 'show'])
            ->name('perbandingan.show');
        Route::put('perbandingan/{criteria_analysis}', [CriteriaPerbandinganController::class, 'update'])
            ->name('perbandingan.update');
        Route::delete('perbandingan/{criteria_analysis}', [CriteriaPerbandinganController::class, 'destroy'])
            ->name('perbandingan.destroy');
        // perbandingan hasil
        Route::get('perbandingan/result/{criteria_analysis}', [CriteriaPerbandinganController::class, 'result'])
            ->name('perbandingan.result');
        Route::get('perbandingan/result/detailr/{criteria_analysis}', [CriteriaPerbandinganController::class, 'detailr'])
            ->name('perbandingan.detailr');
        // ranking
        Route::get('ranking', [RankingController::class, 'index'])
            ->name('rank.index');
        Route::get('ranking/{criteria_analysis}', [RankingController::class, 'show'])
            ->name('rank.show');
        Route::get('ranking/student/{criteria_analysis}', [RankingController::class, 'final'])
            ->name('rank.final');
        Route::get('ranking/student/detailr/{criteria_analysis}', [RankingController::class, 'detailr'])
            ->name('rank.detailr');
        // import
        Route::post('students/import', [StudentController::class, 'import'])
            ->name('students.import');
        Route::post('users/import', [UserController::class, 'import'])
            ->name('users.import');
        Route::post('alternatives/import', [AlternativeController::class, 'import'])
            ->name('alternatives.import');
        // export
        Route::get('students/export', [StudentController::class, 'export'])
            ->name('students.export');
        Route::get('alternatives/export', [AlternativeController::class, 'export'])
            ->name('alternatives.export');
        Route::get('ranking/export/{criteria_analysis}', [RankingController::class, 'export'])
            ->name('rank.export');
    });
