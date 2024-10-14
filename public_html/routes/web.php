<?php

use App\Models\User;
use App\Models\Article;
use App\Models\Organisasi;
use App\Models\Ad;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\EkstrakurikulerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

    Route::get('/ekstrakurikuler/{slug}', [EkstrakurikulerController::class, 'show'])->name('ekstrakurikuler.show');



    Route::view('/ekstrakurikuler', 'frontend.ekstrakurikuler.index', [
        'organisasis' => Organisasi::all()
    ]);

    Route::get('/article/{slug}', function($slug) {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('frontend.article.show', compact('article'));
    })->name('article.show');

    Route::get('/article', function () {
        $articles = Article::all(); // Mengambil semua artikel dari database
        return view('frontend.article.index', compact('articles')); // Mengirimkan data artikel ke view
    });

    Route::get('/', function () {
        $ads = Ad::all();
        $articles = Article::all();
        return view('frontend.home.homepage', compact('articles','ads'));
    });

    
    Route::get('/fasilitas', function () {
        return view('frontend/fasilitas');
    });
    Route::get('/prestasi', function () {
        return view('frontend/prestasi');
    });
    Route::get('/profil', function () {
        return view('frontend/profile');
    });

    Route::get('/wargaSekolah/alumni', function () {
        return view('frontend/wargaSekolah/alumni');
    });
    Route::get('/wargaSekolah/dataGuru', function () {
        $users = User::where('role', 'teacher')->get(); // Misalnya, ambil semua user dengan peran 'guru'
        return view('frontend.wargaSekolah.dataGuru', compact('users'));
    });
    Route::get('/wargaSekolah/dataStaff', function () {
        return view('frontend/wargaSekolah/dataStaff');
    });
 




// Jika Telah Login
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/perangkat', [DocumentController::class, 'index'])->name('perangkat');
    Route::delete('/documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');
    Route::post('/upload', [DocumentController::class, 'store'])->name('upload.file');
    Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');

    Route::resource('articles', ArticleController::class);

    // Jika Telah Login Dan Role Admin

    
});

Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    
    Route::resource('subjects', SubjectController::class);
    
    Route::resource('ads', AdController::class);

    Route::get('/organisasi', [OrganisasiController::class, 'index'])->name('organisasi.index');
    Route::get('/organisasi/create', [OrganisasiController::class, 'create'])->name('organisasi.create');
    Route::post('/organisasi', [OrganisasiController::class, 'store'])->name('organisasi.store');
    Route::get('/organisasi/{organisasi}/edit', [OrganisasiController::class, 'edit'])->name('organisasi.edit');
    Route::put('/organisasi/{organisasi}', [OrganisasiController::class, 'update'])->name('organisasi.update');
    Route::delete('/organisasi/{organisasi}', [OrganisasiController::class, 'destroy'])->name('organisasi.destroy');
});


// Login
require __DIR__.'/auth.php';
