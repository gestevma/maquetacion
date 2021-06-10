<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Http\Controllers\Controller;
use App\Vendor\Locale\Manager;
use App\Vendor\Locale\Locale;
use App\Vendor\Locale\Models\LocaleLanguage;
use App\Vendor\Locale\Models\LocaleTag;
use \Debugbar;


class LocaleTagController extends Controller
{
    protected $locale_tag;
    protected $locale;
    protected $agent;
    protected $paginate;
    protected $language;
    protected $manager;

    function __construct(LocaleTag $locale_tag, Agent $agent, Locale $locale, LocaleLanguage $language, Manager $manager)
    {
        // $this->middleware('auth');
        $this->locale_tag = $locale_tag;
        $this->agent = $agent;
        $this->locale = $locale;
        $this->language = $language;
        $this->manager = $manager;

        if ($this->agent->isMobile()) {
            $this->paginate = 10;
        }

        if ($this->agent->isDesktop()) {
            $this->paginate = 10;
        }
    }



    public function index()
    {
        
        $tags = $this->locale_tag
            ->select('group', 'key')
            ->groupBy('group', 'key')
            ->where('group', 'not like', 'admin/%')
            ->where('group', 'not like', 'front/seo')
            ->paginate($this->paginate);
               

        $view = View::make('admin.tags.index')
            ->with('tag', $this->locale_tag)
            ->with('tags', $tags);
            

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
        $view = View::make('admin.tags.index')
        ->with('tag', $this->locale_tag)
        ->with('tags', $this->locale_tag->paginate($this->paginate))
        ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }



    public function store(Request $request)
    {            
        
        foreach (request('tag') as $rel_anchor => $value){

            $rel_anchor = str_replace(['-', '_'], ".", $rel_anchor); 
            $explode_rel_anchor = explode('.', $rel_anchor);
            $language = end($explode_rel_anchor);

            $locale_tag = $this->locale_tag::updateOrCreate([
                'language' => $language,
                'group' => request('group'),
                'key' => request('key')],[
                'value' => $value,
                'active' => 1
            ]);
        }
        
        $this->manager->exportTranslations(request('group'));   

        $tags = $this->locale_tag
        ->select('group', 'key')
        ->groupBy('group', 'key')
        ->where('group', 'not like', 'admin/%')
        ->where('group', 'not like', 'front/seo')
        ->paginate($this->paginate);  


        $view = View::make('admin.tags.index')
        ->with('tags', $tags)
        ->with('tag', $this->locale_tag)
        ->renderSections(); 

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
        ]);
    }


    public function show($group, $key){

        $tags = $this->locale_tag->where('key', $key)->where('group', str_replace('-', '/' , $group))->paginate($this->paginate); 
        $tag = $tags->first();

        $languages = $this->language->get();

        foreach($languages as $language){
            $locale = $tags->filter(function($item) use($language) {
                return $item->language == $language->alias;
            })->first();

            $tag['value.'. $language->alias] = empty($locale->value) ? '': $locale->value; 
        }
        
        $view = View::make('admin.tags.index')
        ->with('tags', $tags)
        ->with('tag', $tag);
        
        if(request()->ajax()) {
            $sections = $view->renderSections(); 
    
            return response()->json([
                'table' => $sections['table'],
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }


    public function destroy(LocaleTag $locale_tag)
    {

    }


    public function filter(Request $request, $filters = null){

        $filters = json_decode($request->input('filters'));
        
        $query = $this->locale_tag->query();

        if($filters != null){

            $query->when($filters->group, function ($q, $group) {

                if($group == 'all'){
                    return $q;
                }
                else{
                    return $q->where('group', $group);
                }
            });

            $query->when($filters->key, function ($q, $key) {

                if($key == 'all'){
                    return $q;
                }
                else{
                    return $q->where('key', $key);
                }
            });
    
            $query->when($filters->order, function ($q, $order) use ($filters) {
    
                $q->orderBy($order, $filters->direction);
            });

    
            $query->when($filters->order, function ($q, $order) use ($filters) {
    
                $q->orderBy($order, $filters->direction);
            });
        }
    
        $tags = $query->select('group', 'key')
                ->groupBy('group', 'key')
                ->where('group', 'not like', 'admin/%')
                ->where('group', 'not like', 'front/seo')
                ->paginate($this->paginate)
                ->appends(['filters' => json_encode($filters)]);  

        $view = View::make('admin.tags.index')
            ->with('tags', $tags)
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
        ]);
    }



    
    public function importTags()
    {
        $this->manager->importTranslations();  
        $message =  \Lang::get('admin/tags.tag-import');

        $tags = $this->locale_tag
        ->select('group', 'key')
        ->groupBy('group', 'key')
        ->where('group', 'not like', 'admin/%')
        ->where('group', 'not like', 'front/seo')
        ->paginate($this->paginate);  

        $view = View::make('admin.tags.index')
            ->with('tags', $tags)
            ->with('tag', $this->locale_tag);

        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'table' => $sections['table'],
                'message' => $message,
            ]); 
        }
    }

}

/*Ahora mismo lo de filtrar por fechas no me funciona si lo arreglo cambiare esto*/

