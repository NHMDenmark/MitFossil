<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Curator\HomeController as CuratorHomeController;
use App\Http\Controllers\Customer\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

Route::group(['prefix' => '', 'as' => 'customer.', 'middleware' => ['verified']], function () {
    Route::get('/dashboard', [\App\Http\Controllers\Customer\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/identify-finds', [\App\Http\Controllers\Customer\IdentifyFindsController::class, 'index'])->name('identify-finds');
    Route::get('/resources', [\App\Http\Controllers\Customer\ResourceController::class, 'index'])->name('resources');
    Route::get('/resources/map', [\App\Http\Controllers\Customer\ResourceController::class, 'map'])->name('resources.map');
    Route::get('/resources/{resource}', [\App\Http\Controllers\Customer\ResourceController::class, 'show'])->name('resources.show')->where('resource', '.*');;
    Route::get('/news/{news}', [\App\Http\Controllers\Customer\NewsController::class, 'show'])->name('news.show');
    Route::get('/e-museum', [\App\Http\Controllers\Customer\EMuseumController::class, 'index'])->name('e-museum');
    Route::get('/e-museum/validated', [\App\Http\Controllers\Customer\EMuseumController::class, 'experts'])->name('e-museum.experts');
    Route::get('/e-museum/scientific', [\App\Http\Controllers\Customer\EMuseumController::class, 'curated'])->name('e-museum.curated');
    Route::get('/e-museum/danekrae', [\App\Http\Controllers\Customer\EMuseumController::class, 'fossil_experts'])->name('e-museum.fossil_experts');
    Route::get('/fossil-catalogue', [\App\Http\Controllers\Customer\EMuseumController::class, 'map'])->name('e-museum.map');
});

Route::group(['prefix' => '', 'as' => 'customer.', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/notifications', [\App\Http\Controllers\Customer\NotificationsController::class, 'index'])->name('notifications');
    Route::put('/notifications/update/{notification}', [\App\Http\Controllers\Customer\NotificationsController::class, 'update'])->name('notifications.update');

    Route::delete('/new-fossil', [\App\Http\Controllers\Customer\NewFossilController::class, 'destroy'])->name('new-fossil.destroy');
    Route::get('/edit-fossil/{fossil}', [\App\Http\Controllers\Customer\NewFossilController::class, 'edit'])->name('new-fossil.edit');
    Route::put('/update-fossil/{fossil}', [\App\Http\Controllers\Customer\NewFossilController::class, 'update'])->name('new-fossil.update');
});

Route::group(['prefix' => '', 'as' => 'customer.', 'middleware' => ['auth', 'verified', 'role:customer,curator']], function () {
    Route::get('/my-collection', [\App\Http\Controllers\Customer\CollectionsController::class, 'index'])->name('my-collection');
    Route::get('/new-fossil', [\App\Http\Controllers\Customer\NewFossilController::class, 'index'])->name('new-fossil');
    Route::post('/new-fossil', [\App\Http\Controllers\Customer\NewFossilController::class, 'store'])->name('new-fossil.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('', [HomeController::class, 'index'])->name('home');

    Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');

    Route::resource('users', \App\Http\Controllers\Admin\UsersController::class);
    Route::resource('customer', \App\Http\Controllers\Admin\CustomerController::class);
    Route::resource('copyright-rules', \App\Http\Controllers\Admin\CopyrightRulesController::class);
    Route::resource('fossil-classes', \App\Http\Controllers\Admin\FossilClassesController::class);
    Route::resource('fossil-commons', \App\Http\Controllers\Admin\FossilCommonsController::class);
    Route::resource('fossil-kingdoms', \App\Http\Controllers\Admin\FossilKingdomsController::class);
    Route::resource('fossil-phylums', \App\Http\Controllers\Admin\FossilPhylumsController::class);
    Route::resource('fossil-families', \App\Http\Controllers\Admin\FossilFamiliesController::class);
    Route::resource('fossil-genres', \App\Http\Controllers\Admin\FossilGenresController::class);
    Route::resource('fossil-subgenres', \App\Http\Controllers\Admin\FossilSubgenresController::class);
    Route::resource('fossil-orders', \App\Http\Controllers\Admin\FossilOrdersController::class);
    Route::resource('fossil-subspecies', \App\Http\Controllers\Admin\FossilSubspeciesController::class);
    Route::resource('fossil-taxonomies', \App\Http\Controllers\Admin\FossilTaxonomiesController::class);
    Route::resource('specific-epithets', \App\Http\Controllers\Admin\SpecificEpithetsController::class);
    Route::resource('resources', \App\Http\Controllers\Admin\ResourcesController::class);
    Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);
    Route::resource('map-resources',\App\Http\Controllers\Admin\MapResourcesController::class);
    Route::resource('fossil-region',\App\Http\Controllers\Admin\FossilRegionsController::class);
    Route::resource('fossil-speciality',\App\Http\Controllers\Admin\FossilSpecialiesController::class);
    Route::resource('files',\App\Http\Controllers\Admin\FilesController::class);

    Route::resource('eons',\App\Http\Controllers\Admin\EonsController::class);
    Route::resource('eras',\App\Http\Controllers\Admin\ErasController::class);
    Route::resource('periods',\App\Http\Controllers\Admin\PeriodsController::class);
    Route::resource('epochs',\App\Http\Controllers\Admin\EpochsController::class);
    Route::resource('ages',\App\Http\Controllers\Admin\AgesController::class);

    Route::get('/notifications', [\App\Http\Controllers\Admin\NotificationsController::class, 'index'])->name('notifications');
    Route::put('/notifications/update/{notification}', [\App\Http\Controllers\Admin\NotificationsController::class, 'update'])->name('notifications.update');

    Route::post('pages', [App\Http\Controllers\Admin\PagesController::class, 'store'])->name('pages.store');
});

require __DIR__.'/auth.php';
