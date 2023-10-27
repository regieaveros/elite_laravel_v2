<?php

use App\Http\Controllers\CrewController;
use App\Http\Controllers\CrewDocumentController;

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsertypeController;
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

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Auth::routes();

Route::middleware('auth')->group(function () {

    //Crew List | Dashboard
    Route::controller(HomeController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('home');
        Route::get('/dashboard/{id}/crew/list', 'show')->name('crewlist');
    });

    //Users
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'users')->name('users');
        Route::get('/users/data', 'index')->name('users.data');
        Route::get('/user/create', 'create')->name('users.create');
        Route::get('/user/{id}', 'show')->name('users.show');
        Route::post('/user/store', 'store')->name('users.store');
        Route::get('/user/edit/{id}', 'edit')->name('users.edit');
        Route::put('/user/update/{id}', 'update')->name('users.update');
        Route::delete('/user/delete/{id}', 'destroy')->name('users.delete');
    });

    //Usertypes
    Route::controller(UsertypeController::class)->group(function () {
        Route::get('/usertypes', 'usertypes')->name('usertypes');
        Route::get('/usertypes/data', 'index')->name('usertypes.data');
        Route::get('/usertype/create', 'create')->name('usertypes.create');
        Route::post('/usertype/store', 'store')->name('usertypes.store');
        Route::get('/usertype/edit/{id}', 'edit')->name('usertypes.edit');
        Route::put('/usertype/update/{id}', 'update')->name('usertypes.update');
        Route::delete('/usertype/delete/{id}', 'destroy')->name('usertypes.delete');
    });

    //Documents
    Route::controller(DocumentController::class)->group(function () {
        Route::get('/documents', 'documents')->name('documents');
        Route::get('/document/data', 'index')->name('documents.data');
        Route::get('/document/create', 'create')->name('documents.create');
        Route::post('/document/store', 'store')->name('documents.store');
        Route::get('/document/edit/{id}', 'edit')->name('documents.edit');
        Route::put('/document/update/{id}', 'update')->name('documents.update');
        Route::delete('/document/delete/{id}', 'destroy')->name('documents.delete');
    });

    //Ranks
    Route::controller(RankController::class)->group(function () {
        Route::get('/ranks', 'ranks')->name('ranks');
        Route::get('/ranks/data', 'index')->name('ranks.data');
        Route::get('/rank/create', 'create')->name('ranks.create');
        Route::post('/rank/store', 'store')->name('ranks.store');
        Route::get('/rank/edit/{id}', 'edit')->name('ranks.edit');
        Route::put('/rank/update/{id}', 'update')->name('ranks.update');
        Route::delete('/rank/delete/{id}', 'destroy')->name('ranks.delete');
    });

    //Crews
    Route::controller(CrewController::class)->group(function () {
        Route::get('/crews', 'crews')->name('crews');
        Route::get('/crews/data', 'index')->name('crews.data');
        Route::get('/crew/create', 'create')->name('crews.create');
        Route::get('/crew/{id}', 'show')->name('crews.show');
        Route::post('/crew/store', 'store')->name('crews.store');
        Route::get('/crew/edit/{id}', 'edit')->name('crews.edit');
        Route::put('/crew/update/{id}', 'update')->name('crews.update');
        Route::delete('/crew/delete/{id}', 'destroy')->name('crews.delete');
    });

    //Crew Documents
    Route::controller(CrewDocumentController::class)->group(function () {
        Route::get('/crew/{id}/documents', 'show')->name('crewdocuments.show');
        Route::post('/crew/document/store', 'store')->name('crewdocuments.store');
        Route::post('/crew/document/update/{id}', 'update')->name('crewdocuments.update');
        Route::delete('/crew/document/delete/{id}', 'destroy')->name('crewdocuments.delete');
    });
});
