<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'admin', 'as' => 'api.admin.', 'middleware' => ['auth:sanctum', 'role:admin']], function () {
    Route::get('search', [\App\Http\Controllers\Api\Admin\SearchController::class, 'search'])->name('search');
    Route::post('/resources', [\App\Http\Controllers\Api\Admin\ResourcesController::class, 'store'])->name('resources.store');
    Route::post('/files', [\App\Http\Controllers\Api\Admin\FilesController::class, 'index'])->name('files');
});

Route::group(['prefix' => 'customer', 'as' => 'api.customer.'], function () {
    Route::get('/fossil/my-collection', [\App\Http\Controllers\Api\Customer\FossilApiController::class, 'my_collection'])->name('fossil.my-collection');
    Route::get('/fossil/identify', [\App\Http\Controllers\Api\Customer\FossilApiController::class, 'identify'])->name('fossil.identify');
    Route::get('/fossil/curated', [\App\Http\Controllers\Api\Customer\FossilApiController::class, 'curated'])->name('fossil.curated');
    Route::get('/fossil/experts', [\App\Http\Controllers\Api\Customer\FossilApiController::class, 'experts'])->name('fossil.experts');
    Route::get('/fossil/map', [\App\Http\Controllers\Api\Customer\FossilApiController::class, 'map'])->name('fossil.map');
    Route::get('/fossil/fossil-experts', [\App\Http\Controllers\Api\Customer\FossilApiController::class, 'fossil_experts'])->name('fossil.fossil-experts');
    Route::get('/news', [\App\Http\Controllers\Api\Customer\NewsApiController::class, 'index'])->name('news');
    Route::get('/fossil/identify-data', [\App\Http\Controllers\Api\Customer\FossilApiController::class, 'identify_data'])->name('fossil.identify-data');
    Route::post('/fossil/save-identify', [\App\Http\Controllers\Api\Customer\FossilApiController::class, 'save_identify'])->name('fossil.save-identify');
    Route::post('/fossil/users-votes', [\App\Http\Controllers\Api\Customer\FossilApiController::class, 'users_votes'])->name('fossil.users-votes');
});

Route::group(['prefix' => 'customer', 'as' => 'api.customer.', 'middleware' => ['auth:sanctum', 'role:customer,curator,admin']], function () {
    Route::get('/user/state', [\App\Http\Controllers\Api\Customer\UserApiController::class, 'state'])->name('user.state');

    Route::post('/notification/notify', [\App\Http\Controllers\Api\NotificationApiController::class, 'notify'])->name('notification.notify');
    Route::post('/notification/report', [\App\Http\Controllers\Api\NotificationApiController::class, 'report'])->name('notification.report');
    Route::post('/notification/deleted-fossil', [\App\Http\Controllers\Api\NotificationApiController::class, 'deleted_fossil'])->name('notification.deleted-fossil');

    Route::post('/fossil/vote-user', [\App\Http\Controllers\Api\Customer\FossilApiController::class, 'vote_user'])->name('fossil.vote-user');
    Route::post('/fossil/vote-curator', [\App\Http\Controllers\Api\Customer\FossilApiController::class, 'vote_curator'])->name('fossil.vote-curator');
    Route::post('/fossil/vote-scientific', [\App\Http\Controllers\Api\Customer\FossilApiController::class, 'vote_scientific'])->name('fossil.vote-scientific');
    Route::post('/fossil/vote-danekrae', [\App\Http\Controllers\Api\Customer\FossilApiController::class, 'vote_danekrae'])->name('fossil.vote-danekrae');
    Route::post('/fossil/add-comment', [\App\Http\Controllers\Api\Customer\FossilApiController::class, 'add_comment'])->name('fossil.add-comment');
    Route::post('/fossil/delete-comment', [\App\Http\Controllers\Api\Customer\FossilApiController::class, 'delete_comment'])->name('fossil.delete-comment');
    Route::post('/fossil/desactive-fossil', [\App\Http\Controllers\Api\Customer\FossilApiController::class, 'desactive_fossil'])->name('fossil.desactive-fossil');
    Route::post('/fossil/active-fossil', [\App\Http\Controllers\Api\Customer\FossilApiController::class, 'active_fossil'])->name('fossil.active-fossil');
});
