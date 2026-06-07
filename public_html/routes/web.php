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
use App\Http\Controllers\SchoolSettingController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\FormerPrincipalController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\AchievementController;
use App\Models\SchoolSetting;

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



    Route::get('/ekstrakurikuler', function() {
        return view('frontend.ekstrakurikuler.index', [
            'organisasis' => Organisasi::all()
        ]);
    });

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
        $settings = SchoolSetting::first() ?? SchoolSetting::createDefault();
        return view('frontend.home.homepage', compact('articles','ads', 'settings'));
    });

    
    Route::get('/galeri', [GalleryController::class, 'publicIndex'])->name('gallery.public');

    Route::get('/fasilitas', function () {
        $facilities = \App\Models\Facility::all();
        return view('frontend.fasilitas', compact('facilities'));
    });
    Route::get('/prestasi', function () {
        $achievements = \App\Models\Achievement::all();
        return view('frontend.prestasi', compact('achievements'));
    });
    Route::get('/profil', function () {
        $settings = SchoolSetting::first() ?? SchoolSetting::createDefault();
        $formerPrincipals = \App\Models\FormerPrincipal::orderBy('id', 'asc')->get();
        return view('frontend/profile', compact('settings', 'formerPrincipals'));
    });

    Route::get('/wargaSekolah/alumni', function () {
        return view('frontend/wargaSekolah/alumni');
    });
    Route::get('/wargaSekolah/dataGuru', function () {
        $users = User::where('role', 'teacher')->get(); // Misalnya, ambil semua user dengan peran 'guru'
        return view('frontend.wargaSekolah.dataGuru', compact('users'));
    });
    Route::get('/wargaSekolah/dataStaff', function () {
        $users = User::where('role', 'staff')->get();
        return view('frontend.wargaSekolah.dataStaff', compact('users'));
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
    Route::get('/documents/{document}/preview', [DocumentController::class, 'preview'])->name('documents.preview');

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

    Route::get('/settings', [SchoolSettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SchoolSettingController::class, 'update'])->name('settings.update');

    Route::patch('/documents/{document}/approve', [DocumentController::class, 'approve'])->name('documents.approve');
    Route::patch('/documents/{document}/reject', [DocumentController::class, 'reject'])->name('documents.reject');

    // Gallery Management
    Route::get('/admin/gallery/backup/all', [GalleryController::class, 'backup'])->name('gallery.backup');
    Route::get('/admin/gallery/download/{gallery}', [GalleryController::class, 'download'])->name('gallery.download');
    Route::resource('gallery', GalleryController::class);
    Route::resource('former-principals', FormerPrincipalController::class);
    Route::resource('facilities', FacilityController::class);
    Route::resource('achievements', AchievementController::class);
});


// Login
require __DIR__.'/auth.php';

// Route for system maintenance page
Route::get('/maintenance', function () {
    return view('maintenance');
})->name('maintenance');

/*
// Helper routes for deployment (cPanel/Domainesia)
Route::get('/deploy-helper/migrate', function () {
    if (request('token') !== 'KyynekoWebsiteSekolah2026') {
        abort(403, 'Unauthorized');
    }
    
    try {
        Artisan::call('migrate', ['--force' => true]);
        $migrateOutput = Artisan::output();
        
        Artisan::call('db:seed', ['--force' => true]);
        $seedOutput = Artisan::output();
        
        return response()->json([
            'status' => 'success',
            'migrate' => $migrateOutput,
            'seed' => $seedOutput
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
});

Route::get('/deploy-helper/clear', function () {
    if (request('token') !== 'KyynekoWebsiteSekolah2026') {
        abort(403, 'Unauthorized');
    }
    
    try {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        
        return response()->json([
            'status' => 'success',
            'message' => 'All cache cleared successfully!'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
});
*/
