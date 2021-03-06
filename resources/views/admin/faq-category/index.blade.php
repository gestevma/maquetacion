@extends('admin.layout.table_form')

@section('table')
    <div class="table-container" id="table-container" data-page="{{$faqs_categories->nextPageUrl()}}">
        {{----Cabezera Tabla escritorio----}}
        @if($agent->isDesktop())
            <div class="thread">
                <div class="one-column-table first head">Categoria</div>
            </div>
        @endif

        {{----Crea las filas de la tabla----}}
        @foreach($faqs_categories as $faq_category_element)
            <div class="table-row swipe-element"> 
                <div class="table-field-container swipe-front">
                    <div class="table-field one-column-table first">@if($agent->isMobile())<p class="table-field-title">Categoria: </p>@endif<p class="table-field-element">{{$faq_category_element->name}}</p></div>
                    {{----Botones de borrar y editar escritorio----}}
                    @if($agent->isDesktop())
                        <div class="buttons">
                            <div class="edit-buttons" id="edit" data-url="{{route('faqs_categories_show', ['faq_category' => $faq_category_element->id])}}">
                                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                                </svg>
                            </div>
                            <div class="eliminate-buttons" id="eliminate" data-url="{{route('faqs_categories_destroy', ['faq_category' => $faq_category_element->id])}}">
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
                        <div class="table-icons edit-button right-swipe" data-url="{{route('faqs_categories_show', ['faq_category' => $faq_category_element->id])}}">
                            <svg viewBox="0 0 24 24">
                                <path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                            </svg>
                        </div> 
                        
                        <div class="table-icons delete-button left-swipe" data-url="{{route('faqs_categories_destroy', ['faq_category' => $faq_category_element->id])}}">
                            <svg viewBox="0 0 24 24">
                                <path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                            </svg>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach

    </div>

    {{----Botones de la paginacii??n. Est??n en otro documento----}}
    @if($agent->isDesktop())
        @include('admin.components.table_pagination', ['items' => $faqs_categories])
    @endif

@endsection


@section('form')
                                                  
                              
    <form class="admin-form" id="faqs-form" action="{{route("faqs_categories_store")}}" autocomplete="off">
    
        <input autocomplete="false" name="hidden" type="text" style="display:none;">
        <input type="hidden" name="id" value="{{isset($faq_category->id) ? $faq_category->id : ''}}">
                        
        {{ csrf_field() }}


        <div class="form-group">
            <div class="form-label">
                <label>A??adir Categoria:</label>
            </div>
            <div class="form-input" id="question">
                <input type="text" class="input" name="name" value="{{isset($faq_category->name) ? $faq_category->name : ''}}" >
            </div>
        </div>

        <div class="form-submit">
            <div class="form-button" id="save-button">
                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z" />
                </svg>
            </div>
        
            <div class="form-button new-entrance-button" id="eliminate-button" data-url="{{route('faqs_categories_create')}}">
                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M17,13H13V17H11V13H7V11H11V7H13V11H17M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                </svg> 
            </div> 
        </div>
    </form>

@endsection