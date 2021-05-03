<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientsRequest;
use App\Models\DB\Clients;

class ClientsController extends Controller
{
    protected $clients;

    function __construct(Clients $clients)
    {
        $this->middleware('auth');

        $this->clients = $clients;
    }

    public function index()
    {

        $view = View::make('admin.clients.index')
                ->with('client', $this->clients)
                ->with('clients', $this->clients->where('active', 1)->paginate(5));

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

        $view = View::make('admin.clients.index')
        ->with('client', $this->clients)
        ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }

    public function store(ClientsRequest $request)
    {            
        $clients = $this->clients->updateOrCreate([
            'id' => request('id')],[
            'name' => request('name'),
            'email' => request('email'),
            'country' => request('country'),
            'region' => request('region'),
            'town' => request('town'),
            'adress' => request('adress'),
            'postcode' => request('postcode'),
            'telephone' => request('telephone'),
            'active' => 1,
        ]);

        $view = View::make('admin.clients.index')
        ->with('clients', $this->clients->where('active', 1)->paginate(5))
        ->with('client', $clients)
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'id' => $clients->id,
        ]);
    }

    public function edit(Clients $clients)
    {
        $view = View::make('admin.clients.index')
        ->with('client', $clients)
        ->with('clients', $this->clients->where('active', 1)->paginate(5));   
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function show(Clients $clients){
        $view = View::make('admin.clients.index')
        ->with('client', $clients)
        ->with('clients', $this->clients->where('active', 1)->paginate(5));   
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function destroy(Clients $clients)
    {
        $clients->active = 0;
        $clients->save();

        $view = View::make('admin.clients.index')
            ->with('client', $this->clients)
            ->with('clients', $this->clients->where('active', 1)->paginate(5))
            ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form']
        ]);
    }
}