<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;

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



Route::get('/', 'WebController@index')->name('web.index');
Route::post('/create', 'WebController@create')->name('web.create');
Route::get('/producto{id}show', 'WebController@show')->name('web.show');
Route::post('/contactanos',[WebController::class,'store'])->name('contactanos.store');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'admin','middleware'=>['admin','auth'],'namespace'=>'admin'],function(){
    Route::get('dashboard', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('profile',  [App\Http\Controllers\Admin\AdminController::class, 'profile'])->name('edit.profile');
    Route::patch('profile/{user}/update', [App\Http\Controllers\Admin\AdminController::class, 'update'])->name('update.profile');
    Route::patch('profile/{user}/updates', [App\Http\Controllers\Admin\AdminController::class, 'updates'])->name('updates.profile');


    // Slider Page All Routes Here
     Route::get('slider', 'SliderController@index')->name('slider.index');
     Route::get('slider/read', 'SliderController@getAll')->name('slider.read');
     Route::post('slider/store', 'SliderController@store')->name('slider.store');
     Route::get('slider/status/{id}', 'SliderController@status');
     Route::delete('slider/{id}/destroy', 'SliderController@destroy');
     Route::get('slider/{id}/edit', 'SliderController@edit');
     Route::put('slider/{id}/update', 'SliderController@update')->name('slider.update');


     Route::get('category', 'CategoryController@index')->name('category.index');
     Route::get('category/read', 'CategoryController@getAll')->name('category.read');
     Route::delete('category/{id}/delete', 'CategoryController@destroy');
     Route::post('category/store', 'CategoryController@store')->name('category.store');
     Route::get('category/status/{id}', 'CategoryController@status');
     Route::get('category/{id}/edit', 'CategoryController@edit');
     Route::put('category/{id}/update', 'CategoryController@update')->name('category.update');
     Route::get('item/category', 'CategoryController@getCategory');


     Route::get('clients', 'ClientController@index')->name('clients.index');
     Route::get('clients/read', 'ClientController@getAll')->name('clients.read');
     Route::delete('clients/{id}/delete', 'ClientController@destroy');
     Route::post('clients/store', 'ClientController@store')->name('clients.store');
     Route::get('clients/status/{id}', 'ClientController@status');
     Route::get('clients/{id}/edit', 'ClientController@edit');
     Route::put('clients/{id}/update', 'ClientController@update')->name('clients.update');

    // Item Page All Routes Here
    Route::get('item', 'ItemController@index')->name('item.index');
    Route::delete('item/{id}/destroy', 'ItemController@destroy');
    Route::get('item/create', 'ItemController@create')->name('item.create');
    Route::post('item/store', 'ItemController@store')->name('item.store');
    Route::get('item/status/{id}', 'ItemController@status');
    Route::get('item/{id}/edit', 'ItemController@edit')->name('item.edit');
    Route::get('item/{id}/editar', 'ItemController@editar')->name('item.editar');
    Route::put('item/{id}/update', 'ItemController@update')->name('item.update');
    Route::put('item/{id}/updates', 'ItemController@updates')->name('item.updates');

     Route::resource('pos','PosController');
     Route::delete('pos/{id}/delete', 'PosController@destroy');
     Route::get('invoice/customer/{id}', 'PosController@customer_invoice_download')->name('customer.invoice.download');
     Route::resource('eventos', 'EventosController');

     Route::get('usuarios', 'UsuariosController@index')->name('usuarios.index');
     Route::delete('usuarios/{id}/delete', 'UsuariosController@destroy');
     Route::get('usuarios/create', 'UsuariosController@create')->name('usuarios.create');
     Route::post('usuarios/store', 'UsuariosController@store')->name('usuarios.store');
     Route::get('usuarios/status/{id}', 'UsuariosController@status');
     Route::get('usuarios/{id}/edit', 'UsuariosController@edit');
     Route::put('usuarios/{id}/update', 'UsuariosController@update')->name('usuarios.update');

     Route::resource('mprimas','MprimasController');
});

Route::group(['prefix'=>'user','middleware'=>['user','auth'],'namespace'=>'user'],function(){
    Route::get('dashboard', [App\Http\Controllers\User\UserController::class, 'index'])->name('user.dashboard');
});
