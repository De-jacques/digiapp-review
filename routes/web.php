<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EntrepotController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Customer;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProformaController;
use App\Http\Controllers\PrinterController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\MouvementController;
use App\Http\Controllers\Profile;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PreReleaseController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\SerialNumberController;
use App\Http\Controllers\Setting;
use App\Http\Controllers\SortieController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Ramsey\Collection\Sort;
use Sabberworm\CSS\Settings;

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


Route::get('/', function () {

    return view('welcome');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::resource('customers', Customer::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('providers', ProviderController::class);
Route::resource('contacts', ContactController::class);
Route::resource('profiles', Profile::class);

Route::resource('settings', Setting::class);

Route::resource('users', UserController::class);

Route::post('/settings/users/{id}', [UserController::class, 'update'])->name('settings.users.update');

Route::group(['prefix' => 'stock'], function () {
    Route::resource('mouvements', MouvementController::class);
});

// Settings

Route::resource('categories', CategorieController::class);
Route::resource('entrepots', EntrepotController::class);
Route::resource('marques', MarqueController::class);
Route::resource('sub_categories', SubCategoryController::class);
Route::resource('stocks', Stock::class);


// Route::resource('/proformas', ProformaController::class);


//Test printer
Route::get('preview', [PDFController::class, 'preview']);
Route::get('generate-pdf', [PDFController::class, 'generatePDF']);


Route::post('/settings/update-marge', [Setting::class, 'updateMarge'])->name('settings.updateMarge');
Route::post('/settings/update-marge-goov', [Setting::class, 'updateMargeGoov'])->name('settings.updateMargeGoov');
Route::get('/quantite-entrepot/{entrepot_id}/{produit_id}', [StockController::class, 'getQuantiteByEntrepot']);

Route::get('/stock/getFournisseur', [StockController::class, 'getFournisseur'])->name('stock.getFournisseur');
Route::get('/stock/getPrestataire', [StockController::class, 'getPrestataire'])->name('stocks.getPrestataire');
Route::POST('/stock/getProductData', [StockController::class, 'getProductData'])->name('stock.getProductData');
// Route::get('/stock/entree/printer', [StockController::class, 'printer'])->name('stock.printerEntree');
Route::delete('/stock/entree/destroy/{entree}', [StockController::class, 'deleteEntree'])->name('entree.destroy');
Route::get('/stock/listProduct', [StockController::class, 'listProduct'])->name('stock.listProduct');


Route::get('/password', [Setting::class, 'pass'])->name('settings.pass');
Route::post('/password', [Profile::class, 'updatePassword'])->name('profiles.password');

Route::get('/{id}', [Customer::class, 'getCustomer'])->name('getCustomer');
Route::resource('sn/serial-number', SerialNumberController::class);
Route::get('sn/stock', [SerialNumberController::class, 'stock'])->name('serial-number.stock');
Route::get('sn/solde', [SerialNumberController::class, 'solde'])->name('serial-number.solde');


Route::group(['prefix' => 'produits'], function () {

    Route::group(['prefix' => 'stocks'], function () {

        Route::post('/getFactureClientByClient', [StockController::class, 'getFactureClientByClient'])->name('stocks.getFactureClientByClient');
        Route::POST('/getFactureInfos', [StockController::class, 'getFactureInfos'])->name('stocks.getFactureInfos');

        Route::group(['prefix' => 'entree'], function () {
            Route::get('/', [StockController::class, 'getEntre'])->name('stocks.entre');
            Route::post('/create', [StockController::class, 'postEntre'])->name('entree.store');
            Route::post('/update/{entree}', [StockController::class, 'updateEntre'])->name('entree.update');
            Route::get('/edit/{entree}', [StockController::class, 'editEntre'])->name('entrees.edit');
            Route::get('/add', [StockController::class, 'getAddEntre'])->name('stock.newEntre');
            Route::get('/impression/{entree}', [PrinterController::class, 'printerEntree'])->name('entree.imprimer');
        });

        Route::resource('sorties', SortieController::class);
        Route::get('/sortie/getCustomer', [SortieController::class, 'getCustomer'])->name('sortie.getCustomer');
        Route::get('/impression/sortie/{sortie}', [PrinterController::class, 'printerSortie'])->name('sortie.imprimer');
    });

    Route::resource('produits', ProduitController::class);
    Route::get('/listProduct', [ProduitController::class, 'listProduct'])->name('listProduct');

    Route::get('/importer_produits', [ProduitController::class, 'importer'])->name('produits.importer');

    Route::resource('/proformas', ProformaController::class);
    Route::get('register/serial-number/{entree}', [SerialNumberController::class, 'makeSn'])->name('serial-number.makeSn');
    Route::get('out/serial-number/{sortie}', [SerialNumberController::class, 'out'])->name('sn.out');
    Route::post('out/serial-number/{sortie}/add', [SerialNumberController::class, 'outOf'])->name('sn.outOf');

    //Ma route serial number
    Route::post('/get-serial-numbers', [SerialNumberController::class, 'getSerialNumbers'])->name('getSerialNumbers');


    Route::post('/pre-releases/add', [PreReleaseController::class, 'store'])->name('pre-releases.store');
    Route::post('/pre-releases/delete/all', [PreReleaseController::class, 'deleteAll'])->name('pre-releases.deleteAll');


    Route::POST('/getProductData', [ProduitController::class, 'getProductData'])->name('getProductData');
    Route::get('/tester_lapp', [Setting::class, 'testmyapp'])->name('testMyApp');
    Route::post('/tester_lapp', [Setting::class, 'testmyappPost'])->name('testmyappPost');

    Route::group(['prefix' => 'proformas'], function () {
        Route::get('/impression/{proforma}', [PrinterController::class, 'imprimer'])->name('imprimer');
        // Route::get('/impression/{proforma}', [PrinterController::class, 'test'])->name('imprimer');
        Route::get('/regeneration/{proforma}', [PrinterController::class, 'regenererProforma'])->name('regenerer');

        Route::group(['prefix' => 'email'], function () {
            Route::get('/{proforma}', [EmailController::class, 'proformaEmail'])->name('sendMail');
        });
    });
});
