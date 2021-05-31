{{-- @php
    $route = 'faqs';
    $filters = ['category' => $faqs_categories, 'search' => true,  'date' => true];
    $order = ['Última actualización' => 't_faqs.updated_at', 'nombre' => 't_faqs.title', 'categoría' => 't_faqs_categories.name']; 
@endphp --}}

@extends('admin.layout.table_form')

@section('table')
    <div class="table-container" id="table-container" data-page="{{$books->nextPageUrl()}}">
        {{----Cabezera Tabla escritorio----}}
        @if($agent->isDesktop())
            <div class="thread">
                <div class="four-columns-table first head">Título</div>
                <div class="four-columns-table second head">Autor</div>
                <div class="four-columns-table fourth head">Género</div>
                <div class="four-columns-table third head">Editorial</div>
            </div>
        @endif

        {{----Crea las filas de la tabla----}}
        @foreach($books as $book_element)
            {{-- <div class = "table-row swipe-element">"{{isset($faq->id) ? "" : 'La tabla está vacia'}}"</div> --}}
            <div class="table-row swipe-element"> 
                <div class="table-field-container swipe-front">
                    <div class="table-field four-columns-table first">@if($agent->isMobile())<p class="table-field-title">Título: </p>@endif<p class="table-field-element">{{$book_element->title}}</p></div>
                    <div class="table-field four-columns-table second">@if($agent->isMobile())<p class="table-field-title">Autor: </p>@endif<p class="table-field-element">{{$book_element->autor}}</p></div>
                    <div class="table-field four-columns-table fourth">@if($agent->isMobile())<p class="table-field-title">Género: </p>@endif<p class="table-field-element">{{$book_element->genre}}</p></div>
                    <div class="table-field four-columns-table third">@if($agent->isMobile())<p class="table-field-title">Editorial: </p>@endif <p class="table-field-element">{{$book_element->editorial}}</p></div>
                    


                    {{----Botones de borrar y editar escritorio----}}
                    @if($agent->isDesktop())
                        <div class=table-buttons>
                            <div class="edit-buttons" id="edit" data-url="{{route('books_show', ['book' => $book_element->id])}}">
                                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                                </svg>
                            </div>
                            <div class="eliminate-buttons" id="eliminate" data-url="{{route('books_destroy', ['book' => $book_element->id])}}">
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
                        <div class="table-icons edit-button right-swipe" data-url="{{route('books_edit', ['book' => $book_element->id])}}">
                            <svg viewBox="0 0 24 24">
                                <path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                            </svg>
                        </div> 
                        
                        <div class="table-icons delete-button left-swipe" data-url="{{route('books_destroy', ['book' => $book_element->id])}}">
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
        @include('admin.components.table_pagination', ['items' => $books])
    @endif

@endsection




@section('form')

    @isset($book)     
        <form class="admin-form" action="{{route("books_store")}}" autocomplete="off">

            <input autocomplete="false" name="hidden" type="text" style="display:none;">
            <input type="hidden" name="id" value="{{isset($book->id) ? $book->id : ''}}">
                            
            {{ csrf_field() }}

            <div class = "form-head">
                <div class="form-parts">
                    <p class="part  part-active" data-part="content">Información del libro</p>
                    <p class="part" data-part="price">Precio</p>
                    <p class="part" data-part="images">Imágenes</p>
                    <p class="part" data-part="seo">Seo</p>
                </div>
                <div class="switch-inactive">@include('admin.components.switch-button')</div>
            </div>
            

            <div class = form-body>

                <div class="form-write part-section active" data-part="content">

                     


                    @component ('admin.components.locale')

                        <div class="form-group">
                            <div class="form-label">
                                <label><p class="form-label-title">Autor:</p></label>
                            </div>
                            <div class="form-input" id="question">
                                <input type="text" class="input" name="autor" value="{{isset($book->autor) ? $book->autor : ''}}" >
                            </div>
                        </div>


                        @foreach ($localizations as $localization)

                            <div class="language-section {{ $loop->first ? 'active':'' }}" data-part="{{$localization->alias}}">
                                <div class="form-group">
                                    <div class="form-label">
                                        <label><p class="form-label-title">Título:</p></label>
                                    </div>
                                    <div class="form-input" id="question">
                                        <input type="text" class="input" name="seo[title.{{$localization->alias}}]" value="{{isset($seo["title.$localization->alias"]) ? $seo["title.$localization->alias"] : ''}}" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-label">
                                        <label><p class="form-label-title">Nombre:</p></label>
                                    </div>
                                    <div class="form-input" id="question">
                                        <input type="text" class="input" name="locale[name.{{$localization->alias}}]" value="{{isset($locale["name.$localization->alias"]) ? $locale["name.$localization->alias"] : ''}}" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-label">
                                        <label><p class="form-label-title">Descripción:</p></label> 
                                    </div>
                                    <div class="form-input" id="answer">
                                        <textarea class="ckeditor input" name="locale[description.{{$localization->alias}}]]" class="input-highlight">{{isset($locale["description.$localization->alias"]) ? $locale["description.$localization->alias"] : ''}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-label">
                                        <label><p class="form-label-title">Editorial:</p></label>
                                    </div>
                                    <div class="form-input" id="question">
                                        <input type="text" class="input"  name="locale[editorial.{{$localization->alias}}]" value="{{isset($locale["editorial.$localization->alias"]) ? $locale["editorial.$localization->alias"] : ''}}" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-label">
                                        <label><p class="form-label-title">Género:</p></label>
                                    </div>
                                    <div class="form-input" id="question">
                                        <input type="text" class="input"  name="locale[genre.{{$localization->alias}}]" value="{{isset($locale["genre.$localization->alias"]) ? $locale["genre.$localization->alias"] : ''}}" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-label">
                                        <label><p class="form-label-title">Tipo de libro:</p></label>
                                    </div>
                                    <div class="form-input" id="question">
                                        <input type="text" class="input"  name="locale[type.{{$localization->alias}}]" value="{{isset($locale["type.$localization->alias"]) ? $locale["type.$localization->alias"] : ''}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-label">
                                        <label><p class="form-label-title">ISBN:</p></label>
                                    </div>
                                    <div class="form-input" id="question">
                                        <input type="text" class="input" name="locale[ISBN.{{$localization->alias}}]" value="{{isset($locale["ISBN.$localization->alias"]) ? $locale["ISBN.$localization->alias"] : ''}}" >
                                    </div>
                                </div>

                               

                            </div>
                        @endforeach
                    @endcomponent

                </div>

                <div class="form-write part-section" data-part="price">
                    <div class="form-group">
                        <div class="form-label">
                            <label><p class="form-label-title">Base Imponible:</p></label> 
                        </div>
                        <div class="form-input" id="answer">
                            <input type="number" class="input" name="product[original_price]" value="{{isset($product["original_price"]) ? $product["original_price"] : ''}}" >
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-label">
                            <label><p class="form-label-title">Descuento(%):</p></label> 
                        </div>
                        <div class="form-input" id="answer">
                            <input type="number" class="input" name="product[discount]" value="{{isset($product["discount"]) ? $product["discount"] : ''}}" >
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-label">
                            <label><p class="form-label-title">IVA(%):</p></label>
                        </div>
                        <div class="form-input">
                            <input type="number" class="input" name="product[taxes]" value="{{isset($product["taxes"]) ? $product["taxes"] : ''}}" >
                            {{-- <select name="taxes"  class="input" data-placeholder="Impuestos" class="input-highlight">
                                <option value="" class="taxes"></option>
                                @foreach($taxes as $tax_element)
                                    <option value="product[{{$tax_element->taxes}}]" {{$book->taxes == $tax_element->taxes ? 'selected':''}} class="category_id">{{ $tax_element->taxes }}</option>
                                @endforeach
                            </select>                    --}}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-label">
                            <label><p class="form-label-title">Stock:</p></label> 
                        </div>
                        <div class="form-input" id="answer">
                            <input type="number" class="input" name="product[stock]" value="{{isset($product["stock"]) ? $product["stock"] : ''}}" >
                        </div>
                    </div>   
                    
                </div>


                <div class="form-images part-section" data-part="images">
                    @component ('admin.components.locale')

                        @foreach ($localizations as $localization)
                            <div class="language-section {{ $loop->first ? 'active':'' }}" data-part="{{$localization->alias}}">
                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="name" class="label-highlight">Foto destacada</label>
                                    </div>
                                    <div class="form-input">
                                        @include('admin.components.upload', [
                                            'entity' => 'books',
                                            'type' => 'single', 
                                            'content' => 'featured', 
                                            'alias' => $localization->alias,
                                            'files' => $book->images_featured_preview
                                        ])
                                    </div>
                                </div>  

                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="name" class="label-highlight">Foto múltiple</label>
                                    </div>
                                    <div class="form-input">
                                        @include('admin.components.upload', [
                                            'entity' => 'books',
                                            'type' => 'collection', 
                                            'content' => 'grid', 
                                            'alias' => $localization->alias,
                                            'files' => $book->images_grid_preview
                                        ])
                                    </div>
                                </div> 
                            </div>
                        @endforeach
                    @endcomponent
                </div>

                <div class="form-write part-section" data-part="seo">
                    

                    @component ('admin.components.locale')

                        @foreach ($localizations as $localization)

                            <div class="language-section {{ $loop->first ? 'active':'' }}" data-part="{{$localization->alias}}">
                                <div class="form-group">
                                    <div class="form-label">
                                        <label><p class="form-label-title">keywords:</p></label>
                                    </div>
                                    <div class="form-input" id="question">
                                        <input type="text" class="input" name="seo[keywords.{{$localization->alias}}]" value="{{isset($seo["keywords.$localization->alias"]) ? $seo["keywords.$localization->alias"] : ''}}" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-label">
                                        <label><p class="form-label-title">description:</p></label> 
                                    </div>
                                    <div class="form-input" id="answer">
                                        <textarea class="input" name="seo[description.{{$localization->alias}}]]" class="input-highlight">{{isset($seo["description.$localization->alias"]) ? $seo["description.$localization->alias"] : ''}}</textarea>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    @endcomponent

                </div>

                <div class="form-submit">
                    <div class="form-button" id="save-button">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z" />
                        </svg>
                    </div>
                
                    <div class="form-button new-entrance-button" id="eliminate-button" data-url="{{route('faqs_create')}}">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M17,13H13V17H11V13H7V11H11V7H13V11H17M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                        </svg> 
                    </div> 
                </div>
            </div>
        </form>
    @endif
   

@endsection