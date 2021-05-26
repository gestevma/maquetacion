{{-- @php
    $route = 'tags';
    $filters = ['group' => $seos, 'key' => $seos];
    $order = ['group' => 't_locale_tag.group', 'Key' => 't_locale_tag.key']; 
@endphp --}}

@extends('admin.layout.table_form')

@section('table')
    <div class="table-container" id="table-container" data-page="{{$seos->nextPageUrl()}}">
        {{----Cabezera Tabla escritorio-- --}}
        @if($agent->isDesktop())
            <div class="thread">
                <div class="one-column-table first head">Clave</div>
                <div class="import-button" data-url="{{route('tags_import')}}">
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M1,12H10.76L8.26,9.5L9.67,8.08L14.59,13L9.67,17.92L8.26,16.5L10.76,14H1V12M19,3C20.11,3 21,3.9 21,5V19A2,2 0 0,1 19,21H5C3.89,21 3,20.1 3,19V16H5V19H19V7H5V10H3V5A2,2 0 0,1 5,3H19Z" />
                    </svg>
                </div>
            </div>
        @endif

        {{----Crea las filas de la tabla----}}
        @foreach($seos as $seo_element)
            {{-- <div class = "table-row swipe-element">"{{isset($faq->id) ? "" : 'La tabla está vacia'}}"</div> --}}
            <div class="table-row swipe-element"> 
                <div class="table-field-container swipe-front">
                    <div class="table-field one-column-table first">@if($agent->isMobile())<p class="table-field-title">clave: </p>@endif<p class="table-field-element">{{$seo_element->key}}</p></div>
                   

                    {{----Botones de borrar y editar escritorio----}}
                    @if($agent->isDesktop())
                        <div class=table-buttons>
                            <div class="edit-buttons" id="edit" data-url="{{route('seo_show', ['key' => str_replace('/', '-' , $seo_element->group) , 'key' => $seo_element->key])}}">
                                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                                </svg>
                            </div>
                        </div>
                    @endif

                </div>

                {{----Swipe del movil para borrar y editar----}}
                @if($agent->isMobile())
                    <div class="table-icons-container swipe-back">
                        <div class="table-icons edit-button right-swipe" data-url="{{route('seo_show', ['key' => str_replace('/', '-' , $seo_element->group) , 'key' => $seo_element->key])}}">
                            <svg viewBox="0 0 24 24">
                                <path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                            </svg>
                        </div> 
                    </div>
                @endif
            </div>
        @endforeach

    </div>

    {{----Botones de la paginación. Están en otro documento----}}
    @if($agent->isDesktop())
        @include('admin.components.table_pagination', ['items' => $seos])
    @endif

@endsection




@section('form')

    @isset($seo)

        <form class="admin-form" action="{{route("seo_store")}}" autocomplete="off">
                            
            {{ csrf_field() }}

            <div class = form-body>

                <div class="form-write part-section active" data-part="content">

                    <div class="form-not-translatable">

                        <div class="form-group">
                            <div class="form-label">
                                <label><p class="form-label-title">clave:</p></label>
                            </div>
                            <div class="form-input">
                                <label class="key">{{isset($seo_element->key) ? $seo_element->key : ''}}</label>
                            </div>
                        </div>
                    </div>

                    
                    
                    <div class="form-translatable">

                        @component ('admin.components.locale')

                            @foreach ($localizations as $localization)

                            <input type="hidden" class="inactivate" name="seo[key.{{$localization->alias}}]" value="{{$seo["key.$localization->alias"]}}">
                            <input type="hidden" class="inactivate" name="seo[group.{{$localization->alias}}]" value="{{$seo["group.$localization->alias"]}}">
                            <input type="hidden" class="inactivate" name="seo[old_url.{{$localization->alias}}]" value="{{isset($seo["url.$localization->alias"]) ? $seo["url.$localization->alias"] : ''}}" class="input-highlight block-parameters"  data-regex="/\{.*?\}/g" >

                                <div class="language-section {{ $loop->first ? 'active':'' }}" data-part="{{$localization->alias}}">
                                    <div class="form-group">
                                        <div class="form-label">
                                            <label><p class="form-label-title">url:</p></label>
                                        </div>
                                        <div class="form-input">
                                        <input type="text" class="input block-input" name="seo[url.{{$localization->alias}}]" value="{{isset($seo["url.$localization->alias"]) ? $seo["url.$localization->alias"] : ''}}" >
                                        </div>  
                                    </div>

                                    <div class="form-group">
                                        <div class="form-label">
                                            <label><p class="form-label-title">Título:</p></label>
                                        </div>
                                        <div class="form-input">
                                        <input type="text" class="input" name="seo[title.{{$localization->alias}}]" value="{{isset($seo["title.$localization->alias"]) ? $seo["title.$localization->alias"] : ''}}" >
                                        </div>  
                                    </div>

                                    <div class="form-group">
                                        <div class="form-label">
                                            <label><p class="form-label-title">keywords:</p></label>
                                        </div>
                                        <div class="form-input">
                                        <input type="text" class="input" name="seo[keywords.{{$localization->alias}}]" value="{{isset($seo["keywords.$localization->alias"]) ? $seo["keywords.$localization->alias"] : ''}}" >
                                        </div>  
                                    </div>

                                    <div class="form-group">
                                        <div class="form-label">
                                            <label><p class="form-label-title">descripción:</p></label>
                                        </div>
                                        <div class="form-input">
                                        <input type="text" class="input" name="seo[description.{{$localization->alias}}]" value="{{isset($seo["description.$localization->alias"]) ? $seo["description.$localization->alias"] : ''}}" >
                                        </div>  
                                    </div>
                                </div>

                                

                            @endforeach
                        @endcomponent
                    </div>
                </div>
                

                <div class="form-submit">
                    <div class="form-button" id="save-button">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z" />
                        </svg>
                    </div>
                </div>
            </div>
        @endif
    </form>

   

@endsection
