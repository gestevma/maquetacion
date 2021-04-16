@extends('admin.layout.table_form')

@section('table')

    <div class="table-container">

        <table>

            <thead>
                <tr>
                    <th>id</th>
                    <th>Título</th>
                    <th>Respuesta</th>
                    <th>Categoria</th>
                    <th></th>     
                </tr>
            </thead>

            @foreach ($faqs as $faq_element)
                <tbody class="table-line" data-url="{{route('faqs_destroy', ['faq' => $faq_element->id])}}">
                    <tr class="saved-faq">
                        <td id="id">{{$faq_element->id}}</td>
                        <td id="title">{{$faq_element->title}}</td>
                        <td id="description">{{$faq_element->description}}</td>
                        <td id="category_id">{{$faq_element->category->name}}</td> 
                        <td class="table-buttons">

                            <div class="edit-button">
                                <button class="edit-buttons" id="edit" data-url="{{route('faqs_show', ['faq' => $faq_element->id])}}">
                                    <svg style="width:24px;height:24px" viewBox="0 0 24 24" class="plus-button">
                                        <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                                    </svg>
                                </button>
                            </div>

                            <div class="eliminate-button">
                                <button class="eliminate-buttons" id="eliminate" data-url="{{route('faqs_destroy', ['faq' => $faq_element->id])}}">
                                    <svg style="width:24px;height:24px" viewBox="0 0 24 24" class="table-button">
                                        <path fill="currentColor" d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                                    </svg> 
                                </button> 
                            </div>      
                        </td>
                    </tr>
                </tbody>
      
            @endforeach
                
            
        </table>
    </div>
    
@endsection


@section('form')
                                                  
                              
    <form class="admin-form" id="faqs-form" action="{{route("faqs_store")}}" autocomplete="off">
    
        
        <input autocomplete="false" name="hidden" type="text" style="display:none;">
        <input type="hidden" name="id" value="{{isset($faq->id) ? $faq->id : ''}}">
                        
        {{ csrf_field() }}
        <div class=form-write>

            <div class="form-group">
                <div class="form-label">
                    <label>Categoria:</label>
                </div>
                <div class="form-input">
                    <select name="category_id" data-placeholder="Seleccione una categoría" class="input-highlight">
                        <option></option>
                        @foreach($faqs_categories as $faq_category)
                            <option value="{{$faq_category->id}}" {{$faq->category_id == $faq_category->id ? 'selected':''}} class="category_id">{{ $faq_category->name }}</option>
                        @endforeach
                    </select>                   
                </div>
            </div>

            <div class="form-group">
                <div class="form-label">
                    <label>Pregunta:</label>
                </div>
                <div class="form-input" id="question">
                    <input type="text" class="input" name="title" value="{{isset($faq->title) ? $faq->title : ''}}" >
                </div>
            </div>

            <div class="form-group">
                <div class="form-label">
                    <label >Respuesta:</label> 
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

   

@endsection
