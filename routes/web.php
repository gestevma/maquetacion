<?php

use Illuminate\Support\Facades\Route;
use App\Vendor\Locale\LocalizationSeo;

$localizationseo = new LocalizationSeo();

// /*
// |--------------------------------------------------------------------------
// | Web Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register web routes for your application. These
// | routes are loaded by the RouteServiceProvider within a group which
// | contains the "web" middleware group. Now create something great!
// |
// */

Route::get('/', function () {
    return view('index');
});

Route::group(['prefix' => 'admin'], function () { /*-->Indica la ruta que seguirá la url*/ 

    //Route::get('/faqs/json', 'App\Http\Controllers\Admin\FaqController@indexJson')->name('faqs_json');
    /*Resources te dice la ruta final de la url*/

    /******Información empresa******/
    Route::get('/informacion-de-la-empresa', 'App\Http\Controllers\Admin\BusinessInformationController@index')->name('business_information');
    Route::post('/informacion-de-la-empresa', 'App\Http\Controllers\Admin\BusinessInformationController@store')->name('business_information_store');


    /******Images******/
    Route::get('/image/delete/{image?}', 'App\Vendor\Image\Image@destroy')->name('delete_image');
    Route::get('/image/temporal/{image?}', 'App\Vendor\Image\Image@showTemporal')->name('show_temporal_image_seo'); 
    Route::get('/image/{image}', 'App\Vendor\Image\Image@show')->name('show_image_seo');
    Route::post('/image/seo', 'App\Vendor\Image\Image@storeSeo')->name('store_image_seo');

    /******Tags******/
    Route::get('/tags/filter/{filters?}', 'App\Http\Controllers\Admin\LocaleTagController@filter')->name('tags_filter');
    Route::get('/tags/{group}/{key}', 'App\Http\Controllers\Admin\LocaleTagController@show')->name('tags_show');
    Route::get('/tags', 'App\Http\Controllers\Admin\LocaleTagController@index')->name('tags');
    Route::post('/tags', 'App\Http\Controllers\Admin\LocaleTagController@store')->name('tags_store');
    Route::get('/tags/import', 'App\Http\Controllers\Admin\LocaleTagController@importTags')->name('tags_import');

    /******Seo******/
    Route::get('/seo/sitemap', 'App\Http\Controllers\Admin\LocaleSeoController@getSitemaps')->name('create_sitemap');
    Route::get('/seo/import', 'App\Http\Controllers\Admin\LocaleSeoController@importSeo')->name('seo_import');
    Route::get('/seo/{key}', 'App\Http\Controllers\Admin\LocaleSeoController@edit')->name('seo_show');
    Route::get('/seo', 'App\Http\Controllers\Admin\LocaleSeoController@index')->name('seo');
    Route::post('/seo', 'App\Http\Controllers\Admin\LocaleSeoController@store')->name('seo_store');
    Route::get('/ping-google', 'App\Http\Controllers\Admin\LocaleSeoController@pingGoogle')->name('ping_google');


    /******menu******/
    Route::get('/menus/item/index/{language?}/{item?}', 'App\Http\Controllers\Admin\MenuItemController@index')->name('menus_item_index');
    Route::get('/menus/item/create/{language?}', 'App\Http\Controllers\Admin\MenuItemController@create')->name('menus_item_create');
    Route::delete('/menus/item/delete/{item?}', 'App\Http\Controllers\Admin\MenuItemController@destroy')->name('menus_item_destroy');
    Route::get('/menus/item/edit/{item?}', 'App\Http\Controllers\Admin\MenuItemController@edit')->name('menus_item_edit');
    Route::post('/menus/item/store', 'App\Http\Controllers\Admin\MenuItemController@store')->name('menus_item_store'); 
    Route::post('/menus/item/reordermenu', 'App\Http\Controllers\Admin\MenuItemController@orderItem')->name('menus_reorder');


    Route::resource('menus', 'App\Http\Controllers\Admin\MenuController', [
        'names' => [
            'index' => 'menus',
            'create' => 'menus_create',
            'store' => 'menus_store',
            'destroy' => 'menus_destroy',
            'edit' => 'menus_edit',
        ]
    ]);

    
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


    Route::get('/books/filter/{filters?}', 'App\Http\Controllers\Admin\BookController@filter')->name('book_filter');
    Route::get('/books/pagination', 'App\Http\Controllers\Admin\BookController@pagination')->name('book_pagination');
    Route::resource('books', 'App\Http\Controllers\Admin\BookController', [
        'names' => [
            'index' => 'books',
            'create' => 'books_create',
            'store' => 'books_store',
            'destroy' => 'books_destroy',
            'show' => 'books_show',
            'edit' => 'books_edit',
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



Route::group(['prefix' => $localizationseo->setLocale(),
              'middleware' => [ 'localize' ]
            ], function () use ($localizationseo) {

    Route::get($localizationseo->transRoute('routes.front_faqs'), 'App\Http\Controllers\Front\FaqController@index')->name('front_faqs');
    Route::get($localizationseo->transRoute('routes.front_faq'), 'App\Http\Controllers\Front\FaqController@show')->name('front_faq');
    Route::get($localizationseo->transRoute('routes.front_books'), 'App\Http\Controllers\Front\BookController@index')->name('front_books');
    Route::get($localizationseo->transRoute('routes.front_book'), 'App\Http\Controllers\Front\BookController@show')->name('front_book');
    Route::get($localizationseo->transRoute('routes.front_contact'), 'App\Http\Controllers\Front\ContactController@index')->name('front_contact');
});

/*Como hemos puesto prefix=> admin y resource => faqs la url será dev-maquetación.com/admin/faqs*/

Route::post('/fingerprint', 'App\Http\Controllers\Front\FingerprintController@store')->name('front_fingerprint');

Route::get('/login', 'App\Http\Controllers\Front\LoginController@index')->name('front_login');
Route::post('/login', 'App\Http\Controllers\Front\LoginController@login')->name('front_login_submit');


Route::get('/', 'App\Http\Controllers\Front\HomeController@index')->name('home_front');

Route::post('/contacto', 'App\Http\Controllers\Front\ContactController@store')->name('contact_store');

Route::get('/traduccion/{language}/{parent}/{slug?}', 'App\Http\Controllers\Front\LocalizationController@show')->name('front_localization');




