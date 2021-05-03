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

    //1.Pega la linia de los filros así como está
    //2. Ves al JS de filters
    Route::get('/faqs/filter/{filters?}', 'App\Http\Controllers\Admin\FaqController@filter')->name('faqs_filter');
    Route::get('/faqs/pagination', 'App\Http\Controllers\Admin\FaqController@pagination')->name('faqs_pagination');
    Route::resource('faqs', 'App\Http\Controllers\Admin\FaqController', [
        'names' => [
            'index' => 'faqs',
            'create' => 'faqs_create',
            'store' => 'faqs_store',
            'destroy' => 'faqs_destroy',
            'show' => 'faqs_show',
            'edit' => 'faqs_edit',
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
    
    Route::get('/sliders/filter/{filters?}', 'App\Http\Controllers\Admin\FaqController@filter')->name('sliders_filter');
    Route::resource('sliders', 'App\Http\Controllers\Admin\SliderController', [

        'names' => [
            'index' => 'sliders',
            'create' => 'sliders_create',
            'store' => 'sliders_store',
            'destroy' => 'sliders_destroy',
            'show' => 'sliders_show',
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

Route::post('/fingerprint', 'App\Http\Controllers\Front\FingerprintController@store')->name('front_fingerprint');

Route::get('/login', 'App\Http\Controllers\Front\LoginController@index')->name('front_login');
Route::post('/login', 'App\Http\Controllers\Front\LoginController@login')->name('front_login_submit');

Route::get('/faqs', 'App\Http\Controllers\Front\FaqController@index')->name('faqs_front');






