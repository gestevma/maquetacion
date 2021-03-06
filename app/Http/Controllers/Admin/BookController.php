<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BookRequest;
use App\Vendor\Locale\Locale;
use App\Vendor\Locale\LocaleSlugSeo;
use App\Vendor\Image\Image;
use App\Vendor\Product\Product;
use App\Models\DB\Book;
use \Debugbar;

class BookController extends Controller
{
    protected $book;
    protected $image;
    protected $locale;
    protected $locale_slug_seo;
    protected $agent;
    protected $paginate;
    protected $product;

    function __construct(Book $book, Agent $agent, Locale $locale, Image $image, LocaleSlugSeo $locale_slug_seo, Product $product)
    {
        $this->middleware('auth');
        $this->book = $book;
        $this->agent = $agent;
        $this->locale = $locale;
        $this->locale_slug_seo = $locale_slug_seo;
        $this->image = $image;
        $this->product = $product;


        if ($this->agent->isMobile()) {
            $this->paginate = 20;
        }

        if ($this->agent->isDesktop()) {
            $this->paginate = 10;
        }

        $this->locale->setParent('books');
        $this->image->setEntity('books');
        $this->locale_slug_seo->setParent('books');
        $this->product->setParent('books');
    }



    public function index()
    {

        $view = View::make('admin.books.index')
                ->with('book', $this->book)
                ->with('books', $this->book->where('active', 1)->where('visible', 1)->paginate($this->paginate));

        if(request()->ajax()) {
            
            $sections = $view->renderSections(); 
    
            return response()->json([
                'table' => $sections['table'],
                'form' => $sections['form'],
            ]); 
        }

        return $view;
    }



    public function create()
    {

        $view = View::make('admin.books.index')
        ->with('book', $this->book)
        ->with('books', $this->book->where('active', 1)->where('visible', 1)->paginate($this->paginate))
        ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }



    public function store(BookRequest $request)
    {            
        
        $book = $this->book->updateOrCreate([
            'id' => request('id')],[
            'active'=>1,
            'visible'=>1,
            'autor' =>request('autor'),
        ]);
    

        if(request('locale')){
            $locale = $this->locale->store(request('locale'), $book->id);
        }


        if(request('seo')){
            $seo = $this->locale_slug_seo->store(request('seo'), $book->id, 'front_book');
        }
        

        if(request('images')){
            $images = $this->image->store(request('images'), $book->id);
        }

        if(request('product')){
            $product = $this->product->store(request('product'), $book->id);
            
        }


        $view = View::make('admin.books.index')
        ->with('books', $this->book->where('active', 1)->where('visible', 1)->paginate($this->paginate))
        ->with('book', $this->book)
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
        ]);
    }



    public function edit(Book $book)
    {
        $locale = $this->locale->show($book->id);
        $seo = $this->locale_slug_seo->show($book->id);

        $view = View::make('admin.books.index')
        ->with('locale', $locale)
        ->with('seo', $seo)
        ->with('book', $book)
        ->with('books', $this->book->where('active', 1)->where('visible', 1)->paginate($this->paginate));        
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'table' => $sections['table'],
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;;
    }

    public function show(Book $book){

        $locale = $this->locale->show($book->id);
        $seo = $this->locale_slug_seo->show($book->id);
        $product = $this->product->show($book->id);

       

        $view = View::make('admin.books.index')
        ->with('locale', $locale)
        ->with('seo', $seo)
        ->with('product', $product)
        ->with('book', $book)
        ->with('books', $this->book->where('active', 1)->where('visible', 1)->paginate($this->paginate))
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
        ]);
    }

    public function destroy(Book $book)
    {
        $book->active = 0;
        $book->save();

      
        $view = View::make('admin.books.index')
            ->with('book', $this->book)
            ->with('books', $this->book->where('active', 1)->where('visible', 1)->paginate($this->paginate))
            ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form']
        ]);
    }


    // public function filter(Request $request, $filters = null){ //A??ades el $filters = null

    //     $filters = json_decode($request->input('filters')); //Aqui convertimos la url en json para poder encontrar los filtros
        
    //     $query = $this->book->query();

    //     if($filters != null){
    //         /*No se porque pero Carlos ha cambiado la forma de escribir la busqueda de filtros as??
    //         Solo tienes que copiar esto con tus nombres y te deberia funcionar*/
    //         $query->when($filters->category_id, function ($q, $category_id) {

    //             if($category_id == 'all'){
    //                 return $q;
    //             }
    //             else {
    //                 return $q->where('category_id', $category_id);
    //             }
    //         });

    //         $query->when($filters->search, function ($q, $search) {

    //             if($search == null){
    //                 return $q;
    //             }
    //             else {
    //                 return $q->where('t_faqs.title', 'like', "%$search%");
    //             }
    //         });

            
    //         $query->when($filters->initial_date, function ($q, $initial_date) {

    //             if($initial_date == null){
    //                 return $q;
    //             }
    //             else {
    //                 return $q->whereDate('t_faqs.created_at', '>=', $initial_date);
                    
    //             }
    //         });

    //         $query->when($filters->final_date, function ($q, $final_date) {

    //             if($final_date == null){
    //                 return $q;
    //             }
    //             else {
    //                 return $q->whereDate('t_faqs.created_at', '<=', $final_date);
                    
    //             }
    //         });

    //         $query->when($filters->order, function ($q, $order) use ($filters) {

    //             $q->orderBy($order, $filters->direction);
    //         });


    //     }

    //     //Para que te pagine bien tienes que poner la parte de appends, sino se te quitar?? el filtro
    //     $books = $query->where('t_faqs.active', 1)->paginate($this->paginate)->appends(['filters' => json_encode($filters)]); 

    //     $view = View::make('admin.faqs.index')
    //         ->with('books', $books)
    //         ->renderSections();

    //     return response()->json([
    //         'table' => $view['table'],
    //     ]);
    // }
}

/*Ahora mismo lo de filtrar por fechas no me funciona si lo arreglo cambiare esto*/

