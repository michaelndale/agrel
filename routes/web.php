<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlocController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EspeceController;
use App\Http\Controllers\FonctionController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MotifdepenseController;
use App\Http\Controllers\MotifplaneController;
use App\Http\Controllers\MotifstockController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\SiteController;
use App\Models\Motifdepense;
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


Route::get('/', function () { return view('go'); });
Route::get('/logout', [AuthController::class, 'logout'] )->name('logout');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'handlelogin'])->name('handlelogin');

Route::middleware('auth')->group(function (){ 
   

    Route::get('/bienvenu', [HomeController::class, 'index'] )->name('bienvenu');

    //site
    Route::get('/site', [SiteController::class, 'index'] )->name('site');
    Route::post('/storesite', [SiteController::class, 'store'] )->name('storesite');
    Route::delete('/deletesite', [SiteController::class, 'delete'])->name('deletesite');

    //fonction
    Route::get('/fonction', [FonctionController::class, 'index'] )->name('fonction');
    Route::post('/storefonction', [FonctionController::class, 'store'] )->name('storefonction');

    //utilisateur
    Route::get('/user', [Controller::class, 'index'] )->name('user');
    Route::post('/storeuser', [Controller::class, 'store'] )->name('storeuser');

     //utilisateur
     Route::get('/personnel', [PersonnelController::class, 'index'] )->name('personnel');
     Route::post('/storepersonnel', [PersonnelController::class, 'store'] )->name('storepersonnel');

    //fournisseur
     Route::get('/fournisseur', [FournisseurController::class, 'index'] )->name('fournisseur');
     Route::post('/storefournisseur', [FournisseurController::class, 'store'] )->name('storefournisseur');

      //fonction
    Route::get('/espece', [EspeceController::class, 'index'] )->name('espece');
    Route::post('/storeespece', [EspeceController::class, 'store'] )->name('storeespece');

    //fonction
    Route::get('/motifplante', [MotifplaneController::class, 'index'] )->name('motifplante');
    Route::post('/storemotifplante', [MotifplaneController::class, 'store'] )->name('storemotifplante');

    Route::get('/motifstock', [MotifstockController::class, 'index'] )->name('motifstock');
    Route::post('/storemotifstock', [MotifstockController::class, 'store'] )->name('storemotifstock');

    Route::get('/motifdepense', [MotifdepenseController::class, 'index'] )->name('motifdepense');
    Route::post('/storemotifdepense', [MotifdepenseController::class, 'store'] )->name('storemotifdepense');

    Route::get('/bloc', [BlocController::class, 'index'] )->name('bloc');
    Route::post('/storebloc', [BlocController::class, 'store'] )->name('storebloc');
    Route::get('/findbloc',[BlocController::class, 'findbloc'] )->name('findbloc');
    Route::post('/storeparcelle', [BlocController::class, 'storeparcelle'] )->name('storeparcelle');

});