<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqsCategoriesRequest;
use App\Models\DB\FaqCategory;

class FaqsCategoriesController extends Controller
{
    protected $agent;
    protected $paginate;
    protected $faq_category;

    function __construct(FaqCategory $faq_category, Agent $agent)
    {        
        $this->middleware('auth');
        $this->faq_category = $faq_category;
        $this->agent = $agent;

        if ($this->agent->isMobile()) {
            $this->paginate = 10;
        }

        if ($this->agent->isDesktop()) {
            $this->paginate = 6;
        }
        
    }

    public function index()
    {
        $view = View::make('admin.faq-category.index')
        ->with('faq_category', $this->faq_category)
        ->with('faqs_categories', $this->faq_category->where('active', 1)
        ->orderBy('created_at', 'desc')
        ->paginate($this->paginate));
    
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

        $view = View::make('admin.faq-category.index')
        ->with('faq_category', $this->faq_category)
        ->with('faqs_categories', $this->faq_category->where('active', 1)->paginate($this->paginate))
        ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }

    public function store(FaqsCategoriesRequest $request)
    {
       
        $faq_category = FaqCategory::updateOrCreate([
            'id' => request('id')],[
            'name' => request('name'),
            'active' => 1,
        ]);

        $view = View::make('admin.faq-category.index')
        ->with('faqs_categories', $this->faq_category->where('active', 1)->paginate(5))
        ->with('faq_category', $faq_category)
        ->renderSections();

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'id' => $faq_category->id        
        ]);
    }

    public function edit(FaqCategory $faq_category)
    {
                
        $view = View::make('admin.faq-category.index')
        ->with('faq_category', $faq_category);
        
        if(request()->ajax()) {
            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function show(FaqCategory $faq_category)
    {
        $view = View::make('admin.faq-category.index')
        ->with('faq_category', $faq_category)
        ->with('faqs_categories', $this->faq_category->where('active', 1)->paginate(5));   
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function destroy(FaqCategory $faq_category)
    {   
        $faq_category->active = 0;
        $faq_category->save();

        $view = View::make('admin.faq-category.index')
        ->with('faqs_categories', $this->faq_category->where('active', 1)->paginate(5))
        ->with('faq_category', $this->faq_category)
        ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
        ]);
    }
}
