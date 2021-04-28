<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderRequest;
use App\Models\DB\Slider;

class SliderController extends Controller
{
    protected $slider;

    function __construct(Slider $slider)
    {
        $this->middleware('auth');
        $this->slider = $slider;
    }

    public function index()
    {

        $view = View::make('admin.sliders.index')
                ->with('slider', $this->slider)
                ->with('sliders', $this->slider->where('active', 1)->paginate(5));

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

        $view = View::make('admin.sliders.index')
        ->with('slider', $this->slider)
        ->with('sliders', $this->slider->where('active', 1)->paginate(5))
        ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }

    public function store(SliderRequest $request)
    {            
        $slider = $this->slider->updateOrCreate([
            'id' => request('id')],[
            'name' => request('name'),
            'entity' => request('entity'),
            'visible' =>1,
            'active' => 1,
        ]);

        /*if (request('id')){
            $message = \Lang::get('admin/faqs.faq-update');
        }else{
            $message = \Lang::get('admin/faqs.faq-create');
        }*/

        $view = View::make('admin.sliders.index')
        ->with('sliders', $this->slider->where('active', 1)->paginate(5))
        ->with('slider', $slider)
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'id' => $slider->id,
        ]);
    }

    public function edit(Slider $slider)
    {
        $view = View::make('admin.sliders.index')
        ->with('slider', $slider)
        ->with('sliders', $this->slider->where('active', 1)->paginate(5));   
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function show(Slider $slider){
        $view = View::make('admin.sliders.index')
        ->with('slider', $slider)
        ->with('sliders', $this->slider->where('active', 1)->paginate(5));   
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function destroy(Slider $slider)
    {
        $slider->active = 0;
        $slider->save();

        //$message = \Lang::get('admin/faqs.faq-delete');

        $view = View::make('admin.sliders.index')
            ->with('slider', $this->slider)
            ->with('sliders', $this->slider->where('active', 1)->paginate(5))
            ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form']
        ]);
    }


    public function filter(Request $request){

        $query = $this->slider->query();

        $query->when(request('name'), function ($q, $name) {

            if($name == null){
                return $q;
            }
            else {
                return $q->where('name', 'like', "%$name%");
            }
        });

        $query->when(request('entity'), function ($q, $entity) {

            if($search == null){
                return $q;
            }
            else {
                return $q->where('entity', 'like', "%$entity%");
            }
        });

        $query->when(request('visible'), function ($q, $visible) {

            if($search == null){
                return $q;
            }
            else {
                return $q->where('visible', $visible);
            }
        });
        
        
        $query->when(request('initial_date'), function ($q, $initial_date) {

            if($initial_date == null){
                return $q;
            }
            else {
                return $q->whereDate('created_at', '>=', $initial_date);
                
            }
        });

        $query->when(request('final_date'), function ($q, $final_date) {

            if($final_date == null){
                return $q;
            }
            else {
                return $q->whereDate('created_at', '<=', $final_date);
                
            }
        });

        $query->when(request('order'), function ($q, $order) use ($request) {

            $q->orderBy($order, $request->direction);
        });

        $sliders = $query->where('active', 1)->paginate(5);

        $view = View::make('admin.sliders.index')
            ->with('sliders', $sliders)
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
        ]);

    }

    public function filterPagination(){
    }
}

