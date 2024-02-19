<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlocController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\CompteanimalController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\EntreranimalController;
use App\Http\Controllers\EntrestockController;
use App\Http\Controllers\EspeceController;
use App\Http\Controllers\FonctionController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MotifdepenseController;
use App\Http\Controllers\MotifplaneController;
use App\Http\Controllers\MotifstockController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\SalaireController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SortieanimalController;
use App\Http\Controllers\SortiestockController;
use App\Http\Controllers\StatutController;
use App\Http\Controllers\StockController;
use App\Models\Compteanimal;
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
    Route::get('/rapport', [HomeController::class, 'rapport'] )->name('rapport');
    Route::post('/rechercher', [HomeController::class, 'rechercher'] )->name('rechercher');


    Route::get('/diapoelevage', [HomeController::class, 'index'] )->name('diapoelevage');
    Route::get('/diapoculture', [HomeController::class, 'index'] )->name('diapoculture');

    //site
    Route::get('/site', [SiteController::class, 'index'] )->name('site');
    Route::post('/storesite', [SiteController::class, 'store'] )->name('storesite');
    Route::delete('/deletesite', [SiteController::class, 'delete'])->name('deletesite');

    //fonction
    Route::get('/fonction', [FonctionController::class, 'index'] )->name('fonction');
    Route::post('/storefonction', [FonctionController::class, 'store'] )->name('storefonction');


    Route::get('/statut', [StatutController::class, 'index'] )->name('statut');
    Route::post('/storestatut', [StatutController::class, 'store'] )->name('storestatut');

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


    Route::get('/box', [BoxController::class, 'index'] )->name('box');
    Route::post('/storebox', [BoxController::class, 'store'] )->name('storebox');


    Route::get('/credit', [CreditController::class, 'index'] )->name('credit');
    Route::post('/storecredit', [CreditController::class, 'store'] )->name('storecredit');
    Route::delete('deletecredit/{id}', [CreditController::class, 'delete'])->name('deletecredit');


    Route::get('/depense', [DepenseController::class, 'index'] )->name('depense');
    Route::post('/storedepense', [DepenseController::class, 'store'] )->name('storedepense');
    Route::delete('deletedepense/{id}', [DepenseController::class, 'delete'])->name('deletedepense');

    Route::get('/salaire', [SalaireController::class, 'index'] )->name('salaire');
    Route::post('/storesalaire', [SalaireController::class, 'store'] )->name('storesalaire');
    Route::delete('deletesalaire/{id}', [SalaireController::class, 'delete'])->name('deletesalaire');

    Route::get('/stock', [StockController::class, 'index'] )->name('stock');
    Route::get('/compteanimal', [CompteanimalController::class, 'index'] )->name('compteanimal');

    Route::get('/entrerstock', [EntrestockController::class, 'index'] )->name('entrerstock');
    Route::post('/storestock', [EntrestockController::class, 'store'] )->name('storestock');
    Route::delete('deletestock/{id}', [EntrestockController::class, 'delete'])->name('deletestock');


    Route::get('/sortiestock', [SortiestockController::class, 'index'] )->name('sortiestock');
    Route::post('/storesortiestock', [SortiestockController::class, 'store'] )->name('storesortiestock');
    Route::delete('deletesortiestock/{id}', [SortiestockController::class, 'delete'])->name('deletesortiestock');

    Route::get('/entreranimal', [EntreranimalController::class, 'index'] )->name('entreranimal');
    Route::get('/findbox',[EntreranimalController::class, 'findbox'] )->name('findbox');
    Route::post('/storeanimal', [EntreranimalController::class, 'store'] )->name('storeanimal');
    Route::delete('deleteanimal/{id}', [EntreranimalController::class, 'delete'])->name('deleteanimal');


    Route::get('/sortieanimal', [SortieanimalController::class, 'index'] )->name('sortieanimal');
    Route::post('/storesortiesanimal', [SortieanimalController::class, 'store'] )->name('storesortiesanimal');
    Route::delete('deletesortieanimal/{id}', [SortieanimalController::class, 'delete'])->name('deletesortieanimal');

});