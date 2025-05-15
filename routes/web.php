<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActeNaissanceController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\ActeDecesController;
use App\Http\Controllers\ActeMariageController;

// Routes principales
Route::get('/', [App\Http\Controllers\FrontController::class, 'index'])->name('home');

Route::get('/about', [App\Http\Controllers\FrontController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\FrontController::class, 'contact'])->name('contact');
Route::get('/apropos', [App\Http\Controllers\FrontController::class, 'apropos'])->name('apropos');
Route::get('/aproposactedenaissance', [App\Http\Controllers\FrontController::class, 'aproposactedenaissance'])->name('aproposactedenaissance');
Route::get('/aproposactedemariage', [App\Http\Controllers\FrontController::class, 'aproposactedemariage'])->name('aproposactedemariage');
Route::get('/aproposactededeces', [App\Http\Controllers\FrontController::class, 'aproposactededeces'])->name('aproposactededeces');
Route::get('/mesdemandes', [App\Http\Controllers\FrontController::class, 'mesdemandes'])->name('mesdemandes');

// Routes d'authentification
Route::get('/sign-in', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/sign-in', [App\Http\Controllers\AuthController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::get('/sign-up', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::post('/sign-up', [App\Http\Controllers\AuthController::class, 'storeUser'])->name('register.store');

// Routes de réinitialisation de mot de passe
Route::get('/forgot-password', [App\Http\Controllers\AuthController::class, 'forgotPassword'])->name('password.request');
Route::post('/forgot-password', [App\Http\Controllers\AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [App\Http\Controllers\AuthController::class, 'resetPassword'])->name('password.reset');
Route::post('/reset-password', [App\Http\Controllers\AuthController::class, 'updatePassword'])->name('password.update');

// Routes protégées (authentification requise)
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Routes pour les actes d'état civil (exactement comme avant mais protégées)
    Route::get('/welcome', [App\Http\Controllers\FrontController::class, 'welcome'])->name('welcome');
    Route::get('/actedeces', [App\Http\Controllers\FrontController::class, 'actedeces'])->name('actedeces');
    Route::get('/actemariage', [App\Http\Controllers\FrontController::class, 'actemariage'])->name('actemariage');
    Route::get('/actenaissance', [App\Http\Controllers\FrontController::class, 'actenaissance'])->name('actenaissance');
    Route::get('/account', [App\Http\Controllers\FrontController::class, 'account'])->name('account');
   // Dans le groupe middleware(['auth'])
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/dashboard', [App\Http\Controllers\FrontController::class, 'dashboard'])->name('dashboard');
    Route::get('/listeactemariage', [App\Http\Controllers\FrontController::class, 'listeactemariage'])->name('listeactemariage');
    Route::get('/listeactedeces', [App\Http\Controllers\FrontController::class, 'listeactedeces'])->name('listeactedeces');

    //Route pour acte de naissance
    Route::get('/demande/createactenaissance', [ActeNaissanceController::class, 'createactenaissance'])->name('createactenaissance');
    Route::post('/createactenaissance', [ActeNaissanceController::class, 'store'])->name('createactenaissance.store');
    Route::get('/api/localites/{typeId}', [ActeNaissanceController::class, 'getLocalites']);
    Route::get('/listeactenaissance', [ActeNaissanceController::class, 'index'])->name('listeactenaissance');
    Route::get('/actenaissance/{acteNaissance}', [ActeNaissanceController::class, 'show'])->name('actenaissance.show');
    Route::get('/actenaissance/{acteNaissance}/edit', [ActeNaissanceController::class, 'edit'])->name('actenaissance.edit');
    Route::put('/actenaissance/{acteNaissance}', [ActeNaissanceController::class, 'update'])->name('actenaissance.update');
    Route::delete('/actenaissance/{acteNaissance}', [ActeNaissanceController::class, 'destroy'])->name('actenaissance.destroy');
    Route::delete('/actenaissance/{acteNaissance}/document/{documentIndex}', [ActeNaissanceController::class, 'deleteDocument'])->name('actenaissance.deleteDocument')->middleware('auth');
    Route::get('/demande/acte-naissance', function () { return view('frontend.demande.actenaissance');})->name('demandes.acte-naissance.create');
    Route::post('/demande/acte-naissance', [DemandeController::class, 'storeActeNaissance'])->name('demandes.acte-naissance.store');
    Route::get('/demande/acte-naissance/{acte}/details', [DemandeController::class, 'showActeDetails'])->name('demande.actenaissance.details');
    Route::get('/demande/paiement/{demande_id}', [PaiementController::class, 'create'])->name('demandes.paiement.create');
    Route::post('/demande/paiement', [PaiementController::class, 'store'])->name('demandes.paiement.store');


    //Route pour acte de deces
    Route::get('/demande/createactedeces', [ActeDecesController::class, 'createactedeces'])->name('createactedeces');
    Route::post('/createactedeces', [ActeDecesController::class, 'store'])->name('createactedeces.store');
    Route::get('/api/localites/{typeId}', [ActeDecesController::class, 'getLocalites']);
    Route::get('/listeactedeces', [ActeDecesController::class, 'index'])->name('listeactedeces');
    Route::get('/actedeces/{acteDeces}', [ActeDecesController::class, 'show'])->name('actedeces.show');
    Route::get('/actedeces/{acteDeces}/edit', [ActeDecesController::class, 'edit'])->name('actedeces.edit');
    Route::put('/actedeces/{acteDeces}', [ActeDecesController::class, 'update'])->name('actedeces.update');
    Route::delete('/actedeces/{acteDeces}', [ActeDecesController::class, 'destroy'])->name('actedeces.destroy');
    Route::delete('/actedeces/{acteDeces}/document/{documentIndex}', [ActeDecesController::class, 'deleteDocument'])->name('actedeces.deleteDocument')->middleware('auth');
    Route::get('/demande/acte-deces', function () { return view('frontend.demande.actedeces');})->name('demandes.acte-deces.create');
    Route::post('/demande/acte-deces', [DemandeController::class, 'storeActeDeces'])->name('demandes.acte-deces.store');
    Route::get('/demande/acte-deces/{acte}/details', [DemandeController::class, 'showActeDetailsActeDeces'])->name('demande.actedeces.details');
    Route::get('/demande/paiement/{demande_id}', [PaiementController::class, 'create'])->name('demandes.paiement.create');
    Route::post('/demande/paiement', [PaiementController::class, 'store'])->name('demandes.paiement.store');


    //Route pour acte de Mariage
    Route::get('/demande/createactemariage', [ActeMariageController::class, 'createactemariage'])->name('createactemariage');
    Route::post('/createactemariage', [ActeMariageController::class, 'store'])->name('createactemariage.store');
    Route::get('/api/localites/{typeId}', [ActeMariageController::class, 'getLocalites']);
    Route::get('/listeactemariage', [ActeMariageController::class, 'index'])->name('listeactemariage');
    Route::get('/actemariage/{acteMariage}', [ActeMariageController::class, 'show'])->name('actemariage.show');
    Route::get('/actemariage/{acteMariage}/edit', [ActeMariageController::class, 'edit'])->name('actemariage.edit');
    Route::put('/actemariage/{acteMariage}', [ActeMariageController::class, 'update'])->name('actemariage.update');
    Route::delete('/actemariage/{acteMariage}', [ActeMariageController::class, 'destroy'])->name('actemariage.destroy');
    Route::delete('/actemariage/{acteMariage}/document/{documentIndex}', [ActeMariageController::class, 'deleteDocument'])->name('actemariage.deleteDocument')->middleware('auth');
    Route::get('/demande/acte-mariage', function () { return view('frontend.demande.actemariage');})->name('demandes.acte-mariage.create');
    Route::post('/demande/acte-mariage', [DemandeController::class, 'storeActeMariage'])->name('demandes.acte-mariage.store');
    Route::get('/demande/acte-mariage/{acte}/details', [DemandeController::class, 'showActeDetailsActeMariage'])->name('demande.actemariage.details');
    Route::get('/demande/paiement/{demande_id}', [PaiementController::class, 'create'])->name('demandes.paiement.create');
    Route::post('/demande/paiement', [PaiementController::class, 'store'])->name('demandes.paiement.store');
});