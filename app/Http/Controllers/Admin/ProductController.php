<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Vendor\Locale\Locale;
use App\Vendor\Locale\LocaleSlugSeo;
use App\Vendor\Image\Image;
use App\Models\DB\Product;
use \Debugbar;

class ProductController extends Controller
{
    protected $product;
    protected $image;
    protected $locale;
    protected $locale_slug_seo;
    protected $agent;
    protected $paginate;

    function __construct(Product $product, Agent $agent, Locale $locale, Image $image, LocaleSlugSeo $locale_slug_seo)
    {
        $this->middleware('auth');
        $this->sell_characteristic = $product;
        $this->agent = $agent;
        $this->locale = $locale;
        $this->locale_slug_seo = $locale_slug_seo;
        $this->image = $image;

        if ($this->agent->isMobile()) {
            $this->paginate = 20;
        }

        if ($this->agent->isDesktop()) {
            $this->paginate = 10;
        }

        $this->locale->setParent('products');
        $this->image->setEntity('products');
        $this->locale_slug_seo->setParent('products');
    }



    public function index()
    {

        $view = View::make('admin.products.index')
                ->with('product', $this->sell_characteristic)
                ->with('products', $this->sell_characteristic->where('active', 1)->where('visible',1)->paginate($this->paginate));

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

        $view = View::make('admin.products.index')
        ->with('product', $this->sell_characteristic)
        ->with('products', $this->sell_characteristic->where('active', 1)->paginate($this->paginate))
        ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }



    public function store(ProductRequest $request)
    {            


        $product = $this->sell_characteristic->updateOrCreate([
            'id' => request('id')],[
            'product_id' => request('product_id'),
            'original_price' => request('original_price'),
            'taxes' => request('taxes'),
            'discount' => request('discount'),
            'final_price' => request('final_price'),
            'stock' => request('stock'),
            'type' => request('type'),
            'reserved' => request('reserved'),
        

        ]);

        
        if(request('seo')){
            $seo = $this->locale_slug_seo->store(request('seo'), $product->id, 'front_faq');
        }

        if(request('locale')){
            $locale = $this->locale->store(request('locale'), $product->id);
        }

        if(request('images')){
            $images = $this->image->store(request('images'), $product->id);
        }


        $view = View::make('admin.products.index')
        ->with('products', $this->sell_characteristic->where('active', 1)->paginate($this->paginate))
        ->with('product', $this->sell_characteristic)
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
        ]);
    }



    public function edit(Product $product)
    {
        $locale = $this->locale->show($product->id);
        $seo = $this->locale_slug_seo->show($product->id);

        $view = View::make('admin.products.index')
        ->with('locale', $locale)
        ->with('seo', $seo)
        ->with('product', $product)
        ->with('products', $this->sell_characteristic->where('active', 1)->paginate($this->paginate));        
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'table' => $sections['table'],
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;;
    }

    public function show(Product $product){

        $locale = $this->locale->show($product->id);
        $seo = $this->locale_slug_seo->show($product->id);

        $view = View::make('admin.products.index')
        ->with('locale', $locale)
        ->with('seo', $seo)
        ->with('product', $product)
        ->with('products', $this->sell_characteristic->where('active', 1)->paginate($this->paginate))
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
        ]);
    }

    public function destroy(Product $product)
    {
        $product->active = 0;
        $product->save();

      
        $view = View::make('admin.products.index')
            ->with('product', $this->sell_characteristic)
            ->with('products', $this->sell_characteristic->where('active', 1)->paginate($this->paginate))
            ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form']
        ]);
    }


    // public function filter(Request $request, $filters = null){ //Añades el $filters = null

    //     $filters = json_decode($request->input('filters')); //Aqui convertimos la url en json para poder encontrar los filtros
        
    //     $query = $this->sell_characteristic->query();

    //     if($filters != null){
    //         /*No se porque pero Carlos ha cambiado la forma de escribir la busqueda de filtros así
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

    //     //Para que te pagine bien tienes que poner la parte de appends, sino se te quitará el filtro
    //     $products = $query->where('t_faqs.active', 1)->paginate($this->paginate)->appends(['filters' => json_encode($filters)]); 

    //     $view = View::make('admin.faqs.index')
    //         ->with('products', $products)
    //         ->renderSections();

    //     return response()->json([
    //         'table' => $view['table'],
    //     ]);
    // }
}

/*Ahora mismo lo de filtrar por fechas no me funciona si lo arreglo cambiare esto*/

