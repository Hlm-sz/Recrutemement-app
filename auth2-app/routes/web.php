<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\ConcourController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VilleController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware('auth')->group(function () {
    Route::get('/candidatures/create/{concour}', [CandidatureController::class, 'create'])->name('candidatures.create');
    Route::post('/candidatures/{concour}', [CandidatureController::class, 'store'])->name('candidatures.store');
    Route::get('/candidatures/{candidature}/edit/{concour}', [CandidatureController::class, 'edit'])->name('candidatures.edit');
    Route::patch('candidatures/{candidature}/update/{concour}', [CandidatureController::class, 'update'])->name('candidatures.update');
});

// web.php
// Route::middleware(['auth', 'can:delete,user'])->group(function () {
//     Route::delete('/admin/users/{user}', [AdminController::class, 'destroyByAdmin'])->name('admin.users.destroy');
// });

// Route::apiResource('users', UserController::class);


// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::post('/admin/users/store', [UserController::class, 'storeByAdmin'])->name('admin.users.store');
//     // Route::delete('/admin/users/{user}', [UserController::class, 'destroyByAdmin'])->name('admin.users.destroy');
// });

 

// Route::get('/', [ConcourController::class, 'indexcandidat'])->name('concours.indexcandidat');
// // Route::get('/dashboard', [ConcourController::class, 'indexcandidatd'])->name('concours.indexcandidatd')->name('dashboard');
// Route::get('/dashboard', [ConcourController::class, 'indexcandidatd'])->name('dashboard');

// Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/getSpecialites/{filiere_id}', [ConcourController::class, 'getSpecialites']);

// Route::get('/getVilles/{regionID}', [VilleController::class, 'getVilles']);
// Routes protégées par l'authentification et la vérification de l'email
Route::middleware(['auth', 'verified'])->group(function () {
    // Route pour le tableau de bord qui utilise le contrôleur ConcourController
    Route::get('/dashboard', [ConcourController::class, 'indexcandidatd'])->name('dashboard');

    // Route pour le stockage d'utilisateurs par l'administrateur
    Route::post('/admin/users/store', [UserController::class, 'storeByAdmin'])->name('admin.users.store');
    // Route pour la suppression d'utilisateurs par l'administrateur (commentée)
    // Route::delete('/admin/users/{user}', [UserController::class, 'destroyByAdmin'])->name('admin.users.destroy');

    //Route::get('/candidatures/create/{concourId}', [CandidatureController::class, 'create'])->name('candidatures.create');
});

// Route publique pour les candidats
Route::get('/', [ConcourController::class, 'indexcandidat'])->name('concours.indexcandidat');
Route::get('/getSpecialites/{filiere_id}', [ConcourController::class, 'getSpecialites']);
Route::get('/getVilles/{regionID}', [VilleController::class, 'getVilles']);
Route::get('/concours', [ConcourController::class, 'index'])->name('concours.index');


//Route::get('/ministereconcours', [ConcourController::class, 'indexcandidat'])->name('concours.indexcandidat');
Route::get('/concours', [ConcourController::class, 'index'])->name('concours.index');
Route::middleware(['auth', 'admin'])->group(function () {
    //Concour
    // Route::get('/concours', [ConcourController::class, 'index'])->name('concours.index');
    Route::get('/concours/create', [ConcourController::class, 'create'])->name('concours.create');
    Route::post('/concours', [ConcourController::class, 'store'])->name('concours.store');
    Route::get('/concours/{concour}', [ConcourController::class, 'show'])->name('concours.show');
    Route::get('/concours/{concour}/edit', [ConcourController::class, 'edit'])->name('concours.edit');
    Route::put('/concours/{concour}', [ConcourController::class, 'update'])->name('concours.update');
    Route::delete('/concours/{concour}', [ConcourController::class, 'destroy'])->name('concours.destroy');
    
    //Candidature
    //Route::get('/candidatures/create/{concourId}', [CandidatureController::class, 'create'])->name('candidatures.create');
    // Route::post('/candidatures/{concour}', [CandidatureController::class, 'store'])->name('candidatures.store');
    Route::get('/candidatures', [CandidatureController::class, 'index'])->name('candidatures.index');

    //User
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [ConcourController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
   
});

// Route::get('/candidatures/create', [CandidatureController::class, 'create'])->name('candidatures.create');
//Route::post('/candidatures', [CandidatureController::class, 'store'])->name('candidatures.store');
Route::get('/candidatures', [CandidatureController::class, 'index'])->name('candidatures.index');

// Route::get('/concours', [ConcourController::class, 'index'])->name('concours.index');
// Route::get('/concours/create', [ConcourController::class, 'create'])->name('concours.create');
// Route::post('/concours', [ConcourController::class, 'store'])->name('concours.store');
// Route::get('/concours/{concour}', [ConcourController::class, 'show'])->name('concours.show');
// Route::get('/concours/{concour}/edit', [ConcourController::class, 'edit'])->name('concours.edit');
// Route::put('/concours/{concour}', [ConcourController::class, 'update'])->name('concours.update');
// Route::delete('/concours/{concour}', [ConcourController::class, 'destroy'])->name('concours.destroy');


// Route::get('/concours', [ConcourController::class, 'index'])->name('concours.index')->middleware(['auth','admin']);
// Route::get('/concours/create', [ConcourController::class, 'create'])->name('concours.create')->middleware(['auth','admin']);
// Route::post('/concours', [ConcourController::class, 'store'])->name('concours.store')->middleware(['auth','admin']);
// Route::get('/concours/{concour}', [ConcourController::class, 'show'])->name('concours.show')->middleware(['auth','admin']);
// Route::get('/concours/{concour}/edit', [ConcourController::class, 'edit'])->name('concours.edit')->middleware(['auth','admin']);
// Route::put('/concours/{concour}', [ConcourController::class, 'update'])->name('concours.update')->middleware(['auth','admin']);
// Route::delete('/concours/{concour}', [ConcourController::class, 'destroy'])->name('concours.destroy')->middleware(['auth','admin']);

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware(['auth','admin']);
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware(['auth','admin']);
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->middleware(['auth','admin']);

require __DIR__.'/auth.php';

// Route::get('admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
Route::get('admin/dashboard', [HomeController::class, 'dashboardadmin'])->name('admin.dashboard')->middleware(['auth','admin']);
Route::get('validateur/dashboard', [HomeController::class, 'dashboardvalidateur'])->name('admin.validateur')->middleware(['auth','validateur']);
Route::get('lanceurconcour/dashboard', [HomeController::class, 'dashboardlanceurconcour'])->name('admin.lanceurconcour')->middleware(['auth','lanceurconcour']);

Route::get('login', [CandidatController::class, 'showLoginForm'])->name('login');
Route::post('login', [CandidatController::class, 'login']);

Route::get('admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'login']);

