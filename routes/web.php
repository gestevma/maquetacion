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
});
/*Como hemos puesto prefix=> admin y resource => faqs la url será dev-maquetación.com/admin/faqs*/


Route::resource('faqs', 'App\Http\Controllers\Front\FaqController', [
    'names' => [
        'index' => 'faqs',
        //'create' => 'faqs_create',
        //'store' => 'faqs_store',
        //'destroy' => 'faqs_destroy',
        //'show' => 'faqs_show',
    ]
]);
