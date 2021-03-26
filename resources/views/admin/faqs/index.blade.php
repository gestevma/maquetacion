@extends('admin.layout.table_form')

@section('table')

    <div class="table-title">
            <h2>FAQs</h2>
    </div>

    <div class="table-container">

        <table>

            <thead>
                <tr>
                    <th>id</th>
                    <th>Título</th>
                    <th>Respuesta</th>
                    <th></th>     
                </tr>
            </thead>

            @foreach ($faqs as $faq)
                <tbody>
                    <tr class="saved-faq">
                        <td>{{$faq->id}}</td>
                        <td>{{$faq->title}}</td>
                        <td>{{$faq->description}}</td>
                        <td> 
                            <button class="save">
                                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                                </svg>
                            </button>

                            <button class="eliminate">
                                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                                </svg> 
                            </button>        
                        </td>
                    </tr>
                </tbody>
                @php unset($faq) @endphp
            @endforeach
                
            
        </table>
    </div>
    
@endsection


@section('form')
                                                  
                              
    <form class="admin-form" id="faqs-form" action="{{route("faqs_store")}}" autocomplete="off">
    
        
        <input autocomplete="false" name="hidden" type="text" style="display:none;">
        <input type="hidden" name="id" value="{{isset($faq->id) ? $faq->id : ''}}">
                        
        {{ csrf_field() }}

        <div class="form-group">
            <div clsass="form-label">
                <label>Pregunta:</label>
            </div>
            <div class="form-input">
                <input type="text" class="input" value="{{isset($faq->title) ? $faq->title : ''}}" name="title" id="title">
            </div>
        </div>

        <div class="form-group">
            <div class="form-label">
                <label >Respuesta:</label> 
            </div>
            <div class="form-input">
                <textarea type="text" class="input" value="{{isset($faq->description) ? $faq->description : ''}}" name="description" id="Respuesta1" placeholder="Escriba algo"></textarea>
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
