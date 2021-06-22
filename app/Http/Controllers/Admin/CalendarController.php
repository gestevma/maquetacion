<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Http\Controllers\Controller;
use App\Models\DB\Calendar;
use \Debugbar;

class CalendarController extends Controller
{
    protected $calendar;
    protected $paginate;
    protected $agent;

    function __construct(Calendar $calendar, Agent $agent)
    {
        // $this->middleware('auth');
        $this->calendar = $calendar;
        $this->agent = $agent;

        if ($this->agent->isMobile()) {
            $this->paginate = 10;
        }

        if ($this->agent->isDesktop()) {
            $this->paginate = 8;
        }
    }



    public function index()
    {

        $view = View::make('admin.calendar.index')
                ->with('calendar', $this->calendar)
                ->with('calendars', $this->calendar->where('active', 1)->paginate($this->paginate));

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

        $view = View::make('admin.calendar.index')
        ->with('calendar', $this->calendar)
        ->with('calendars', $this->calendar->where('active', 1)->paginate($this->paginate))
        ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }



    public function store(Request $request)
    {                    
        $calendar = $this->calendar->updateOrCreate([
            'id' => request('id')],[
            'active' => 1,
            'title' =>request('title'),
            'description'=>request('description'),
            'start'=>request('start'),
            'finish'=>request('finish'),
        ]);

        $view = View::make('admin.calendar.index')
        ->with('calendars', $this->calendar->where('active', 1)->paginate($this->paginate))
        ->with('calendar', $this->calendar)
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
        ]);
    }



    public function edit(Calendar $calendar)
    {
        $view = View::make('admin.calendar.index')
        ->with('calendar', $calendar)
        ->with('calendars', $this->calendar->where('active', 1)->paginate($this->paginate));   
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function show(Calendar $calendar){
        $view = View::make('admin.calendar.index')
        ->with('calendar', $calendar)
        ->with('calendars', $this->calendar->where('active', 1)->paginate($this->paginate));   
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function destroy(Calendar $calendar)
    {
        $calendar->active = 0;
        $calendar->save();


        $view = View::make('admin.calendar.index')
            ->with('calendar', $this->calendar)
            ->with('calendars', $this->calendar->where('active', 1)->paginate($this->paginate))
            ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form']
        ]);
    }


    public function filter(Request $request, $filters = null){ //Añades el $filters = null

        $filters = json_decode($request->input('filters')); //Aqui convertimos la url en json para poder encontrar los filtros
        
        $query = $this->calendar->query();

        if($filters != null){
            /*No se porque pero Carlos ha cambiado la forma de escribir la busqueda de filtros así
            Solo tienes que copiar esto con tus nombres y te deberia funcionar*/
            $query->when($filters->category_id, function ($q, $category_id) {

                if($category_id == 'all'){
                    return $q;
                }
                else {
                    return $q->where('category_id', $category_id);
                }
            });

            $query->when($filters->search, function ($q, $search) {

                if($search == null){
                    return $q;
                }
                else {
                    return $q->where('t_calendars.title', 'like', "%$search%");
                }
            });

            
            $query->when($filters->initial_date, function ($q, $initial_date) {

                if($initial_date == null){
                    return $q;
                }
                else {
                    return $q->whereDate('t_calendars.created_at', '>=', $initial_date);
                    
                }
            });

            $query->when($filters->final_date, function ($q, $final_date) {

                if($final_date == null){
                    return $q;
                }
                else {
                    return $q->whereDate('t_calendars.created_at', '<=', $final_date);
                    
                }
            });

            $query->when($filters->order, function ($q, $order) use ($filters) {

                $q->orderBy($order, $filters->direction);
            });


        }

        //Para que te pagine bien tienes que poner la parte de appends, sino se te quitará el filtro
        $calendars = $query->where('t_calendars.active', 1)->paginate($this->paginate)->appends(['filters' => json_encode($filters)]); 

        $view = View::make('admin.calendar.index')
            ->with('calendars', $calendars)
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
        ]);
    }
}

/*Ahora mismo lo de filtrar por fechas no me funciona si lo arreglo cambiare esto*/

