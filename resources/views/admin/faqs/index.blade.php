@php
    $route = 'faqs';
    $filters = ['category' => $faqs_categories, 'search' => true,  'date'=>true];
    $order = ['fecha de creación' => 't_faqs.created_at', 'nombre' => 't_faqs.title', 'categoría' => 't_faqs_categories.name']; 
@endphp

@extends('admin.layout.table_form')

@section('table')
    <div class="table-container" id="table-container" data-page="{{$faqs->nextPageUrl()}}">
        {{----Cabezera Tabla escritorio----}}
        @if($agent->isDesktop())
            <div class="thread">
                <div class="three-columns-table first head">Categoria</div>
                <div class="three-columns-table second head">Pregunta</div>
                <div class="three-columns-table third head">Creación</div>
            </div>
        @endif

        {{----Crea las filas de la tabla----}}
        @foreach($faqs as $faq_element)
                <div class="table-row swipe-element">
                    <div class="table-field-container swipe-front">
                        <div class="table-field three-columns-table first">@if($agent->isMobile())<p class="table-field-title">Categoria: </p>@endif <p class="table-field-element">{{$faq_element->category->name}}</p></div>
                        <div class="table-field three-columns-table second">@if($agent->isMobile())<p class="table-field-title">Título: </p>@endif <p class="table-field-element">{{$faq_element->title}}</p></div>
                        <div class="table-field three-columns-table third">@if($agent->isMobile())<p class="table-field-title">Categoria: </p>@endif <p class="table-field-element">{{ Carbon\Carbon::parse($faq_element->created_at)->format('d-m-Y') }}</p></div>

                        {{----Botones de borrar y editar escritorio----}}
                        @if($agent->isDesktop())
                            <div class=buttons>
                                <div class="edit-buttons" id="edit" data-url="{{route('faqs_show', ['faq' => $faq_element->id])}}">
                                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                                    </svg>
                                </div>
                                <div class="eliminate-buttons" id="eliminate" data-url="{{route('faqs_destroy', ['faq' => $faq_element->id])}}">
                                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                                    </svg>
                                </div>
                            </div>
                        @endif

                    </div>

                    {{----Swipe del movil para borrar y editar----}}
                    @if($agent->isMobile())
                        <div class="table-icons-container swipe-back">
                            <div class="table-icons edit-button right-swipe" data-url="{{route('faqs_show', ['faq' => $faq_element->id])}}">
                                <svg viewBox="0 0 24 24">
                                    <path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                                </svg>
                            </div> 
                            
                            <div class="table-icons delete-button left-swipe" data-url="{{route('faqs_destroy', ['faq' => $faq_element->id])}}">
                                <svg viewBox="0 0 24 24">
                                    <path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                                </svg>
                            </div>
                        </div>
                    @endif
                </div>
        @endforeach

    </div>

    {{----Botones de la paginaciión. Están en otro documento----}}
    @if($agent->isDesktop())
        @include('admin.layout.partials.components.table_pagination', ['items' => $faqs])
    @endif

@endsection


@section('form')

    @isset($faq)     
        <form class="admin-form" id="faqs-form" action="{{route("faqs_store")}}" autocomplete="off">

            <div>@include('admin.layout.partials.components.switch-button')</div>

            <div class="new-entrance-button" data-url="{{route("faqs_create")}}">
                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M17,13H13V17H11V13H7V11H11V7H13V11H17M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                </svg> 
            </div> 

            <input autocomplete="false" name="hidden" type="text" style="display:none;">
            <input type="hidden" name="id" value="{{isset($faq->id) ? $faq->id : ''}}">
                            
            {{ csrf_field() }}
            <div class=form-write>

                <div class="form-group">
                    <div class="form-label">
                        <label><p class="form-label-title">Categoria:</p> <p class="error-message" id="category-message">La categoría es obligatoria</p></label>
                    </div>
                    <div class="form-input">
                        <select name="category_id"  class="input" data-placeholder="Seleccione una categoría" class="input-highlight">
                            <option></option>
                            @foreach($faqs_categories as $faq_category)
                                <option value="{{$faq_category->id}}" {{$faq->category_id == $faq_category->id ? 'selected':''}} class="category_id">{{ $faq_category->name }}</option>
                            @endforeach
                        </select>                   
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label">
                        <label><p class="form-label-title">Pregunta:</p> <p class="error-message" data-type="question">El título es obligatorio</p></label>
                    </div>
                    <div class="form-input" id="question">
                        <input type="text" class="input" name="title" value="{{isset($faq->title) ? $faq->title : ''}}" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label">
                        <label><p class="form-label-title">Respuesta:</p> <p class="error-message" id="answer-message">La descripción es obligatoria</p></label> 
                    </div>
                    <div class="form-input" id="answer">
                        <textarea class="ckeditor input" name="description" class="input-highlight">{{isset($faq->description) ? $faq->description : ''}}</textarea>
                    </div>
                </div>
            </div>

            <div class="form-submit">
                <button class="form-button" id="save-button">
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z" />
                    </svg>
                </button>
            
                <button class="form-button" id="eliminate-button">
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                    </svg> 
                </button> 
            </div>
        </form>
    @endif
   

@endsection
