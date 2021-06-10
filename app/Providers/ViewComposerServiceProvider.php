<?php

/*
|--------------------------------------------------------------------------
| Provider para contenidos recurrentes de la web
|--------------------------------------------------------------------------
|   Se sigue la estructura de este ejemplo: https://laracasts.com/series/laravel-5-fundamentals/episodes/25 
|   modificado el archivo config/app providers para incluir este archivo. 
|
|   Con este archivo evitamos tener que repetir código solicitando los contenidos que se repiten en cada vista. 
|
|   Dentro de boot se define en qué vistas y qué contenidos queremos que se carguen. Es posible pasar un array
|   de vistas, para que un mismo contenido esté disponible en ellas cada vez que son renderizadas.
|
|   En la carpeta /app/Http/ViewComposers se define los contenidos que queremos tener disponibles.
|
*/

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{

    public function boot()
    {
        view()->composer([
            'admin.faqs.index'],
            'App\Http\ViewComposers\Admin\FaqsCategories'
        );

        view()->composer([
            'admin.clients.index'],
            'App\Http\ViewComposers\Admin\Countries'
        );

        view()->composer([
            'admin.*',
            'front.components.desktop.localization',
            'front.layout.partials.modal_localization'], 
            'App\Http\ViewComposers\Admin\LocaleLanguage'
        );

        view()->composer([
            'admin.*'], 
            'App\Http\ViewComposers\Admin\Taxes'
        );

        view()->composer([
            'admin.*'], 
            'App\Http\ViewComposers\Admin\Products'
        );

        view()->composer([
            'front.layout.partials.top-bar',
            'front.login.index'],
            'App\Http\ViewComposers\Front\Logo'
        );

        view()->composer(
            'front.layout.partials.footer',
            'App\Http\ViewComposers\Front\LogoLight'
        );

    }

    public function register()
    {
        //
    }
}
