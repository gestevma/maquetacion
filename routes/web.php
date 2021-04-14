<?php

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
    return view('index');
});

Route::group(['prefix' => 'admin'], function () { /*-->Indica la ruta que seguirá la url*/ 

    //Route::get('/faqs/json', 'App\Http\Controllers\Admin\FaqController@indexJson')->name('faqs_json');
    /*Resources te dice la ruta final de la url*/
    Route::resource('faqs', 'App\Http\Controllers\Admin\FaqController', [
        'names' => [
            'index' => 'faqs',
            'create' => 'faqs_create',
            'store' => 'faqs_store',
            'destroy' => 'faqs_destroy',
            'show' => 'faqs_show',
        ]
    ]);
    
    Route::resource('clientes', 'App\Http\Controllers\Admin\ClientsController', [
        'parameters' => [
            'clientes' => 'clients', 
        ],
        'names' => [
            'index' => 'clients',
            'create' => 'clients_create',
            'store' => 'clients_store',
            'destroy' => 'clients_destroy',
            'show' => 'clients_show',
        ]
    ]);

    Route::resource('categorias', 'App\Http\Controllers\Admin\FaqsCategoriesController', [
        'parameters' => [
            'categorias' => 'faq_category', 
        ],
        'names' => [
            'index' => 'faqs_categories',
            'create' => 'faqs_categories_create',
            'store' => 'faqs_categories_store',
            'destroy' => 'faqs_categories_destroy',
            'show' => 'faqs_categories_show',
        ]
    ]);

    Route::resource('users', 'App\Http\Controllers\Admin\UsersController', [

        'names' => [
            'index' => 'users',
            'create' => 'users_create',
            'store' => 'users_store',
            'destroy' => 'users_destroy',
            'show' => 'users_show',
        ]
    ]);
});

/*Como hemos puesto prefix=> admin y resource => faqs la url será dev-maquetación.com/admin/faqs*/


Route::get('/login', 'App\Http\Controllers\Front\LoginController@index')->name('front_login');
Route::post('/login', 'App\Http\Controllers\Front\LoginController@login')->name('front_login_submit');

Route::get('/faqs', 'App\Http\Controllers\Front\FaqFrontController@index')->name('faqs_front');






