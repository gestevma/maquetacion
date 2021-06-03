<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use App\Vendor\Locale\LocaleSlugSeo;
use App\Vendor\Product\Product;
use App\Models\DB\Book;
use Debugbar;

class BookController extends Controller
{
    protected $agent;
    protected $book;
    protected $locale_slug_seo;
    protected $product;

    function __construct(Agent $agent, Book $book, LocaleSlugSeo $locale_slug_seo, Product $product)
    {
        $this->agent = $agent;
        $this->book = $book;
        $this->locale_slug_seo = $locale_slug_seo;
        $this->product = $product;

        $this->locale_slug_seo->setLanguage(app()->getLocale()); 
        $this->locale_slug_seo->setParent('books');
        $this->product->setParent('books');      
    }

    public function index()
    {        
        $seo = $this->locale_slug_seo->getByKey(Route::currentRouteName());

        if($this->agent->isDesktop()){

            $books = $this->book
                    ->with('image_featured_desktop')
                    ->where('active', 1)
                    ->where('visible', 1)
                    ->get();
        }
        
        elseif($this->agent->isMobile()){
            $books = $this->book
                    ->with('image_featured_mobile')
                    ->where('active', 1)
                    ->where('visible', 1)
                    ->get();
        }


        $books = $books->each(function($book){  
            
            $book['locale'] = $book->locale->pluck('value','tag');

            return $book;
        });


        $view = View::make('front.books.index')
                ->with('books', $books)
                ->with('seo', $seo );
        
        return $view;
    }

    public function show($slug)
    {      
        $seo = $this->locale_slug_seo->getIdByLanguage($slug);

        if(isset($seo->key)){

            if($this->agent->isDesktop()){
                $book = $this->book
                    ->with('image_featured_desktop')
                    ->where('active', 1)
                    ->where('visible', 1)
                    ->find($seo->key);

                    // $books = $this->book
                    // ->with('image_featured_desktop')
                    // ->where('active', 1)
                    // ->where('visible', 1)
                    // ->get();
            }
            
            elseif($this->agent->isMobile()){
                $book = $this->book
                    ->with('image_featured_mobile')
                    ->where('active', 1)
                    ->where('visible', 1)
                    ->find($seo->key);
            }

            $book['locale'] = $book->locale->pluck('value','tag');

            $view = View::make('front.books.single')->with('book', $book);

            if(request()->ajax()) {
    
                $sections = $view->renderSections(); 
                return response()->json([
                    'product' => $sections['content'],
                ]); 
    
            }

            return $view;

        }else{
            return response()->view('errors.404', [], 404);
        }
          
    }
}