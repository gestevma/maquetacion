@extends('admin.layout.table_form')

@section('title')

    <h2>
        @lang('admin/users.parent_section')
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left" viewBox="0 0 16 16" class=faq-icon>
            <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
        </svg>
    </h2>     

@endsection

@section('table')

    <div class="table-container">

        <table>

            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th></th>     
                </tr>
            </thead>

            @foreach ($users as $user_element)
                <tbody>
                    <tr class="saved-faq">
                        <td id="id">{{$user_element->id}}</td>
                        <td id="name">{{$user_element->name}}</td>
                        <td id="email">{{$user_element->email}}</td>
                        <td class="table-buttons">

                            <div class="edit-button">
                                <button class="edit-buttons" id="edit" data-url="{{route('users_show', ['user' => $user_element->id])}}">
                                    <svg style="width:24px;height:24px" viewBox="0 0 24 24" class="plus-button">
                                        <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                                    </svg>
                                </button>
                            </div>

                            <div class="eliminate-button">
                                <button class="eliminate-buttons" id="eliminate" data-url="{{route('users_destroy', ['user' => $user_element->id])}}">
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
                                                  
                              
    <form class="admin-form" id="faqs-form" action="{{route("users_store")}}" autocomplete="off">
    
        
        <input autocomplete="false" name="hidden" type="text" style="display:none;">
        <input type="hidden" name="id" value="{{isset($user->id) ? $user->id : ''}}">
                        
        {{ csrf_field() }}
        <div class=form-write>

            <div class="form-group">
                <div class="form-label">
                    <label>Usuario:</label>
                </div>
                <div class="form-input">
                    <input type="text" class="input" name="name" value="{{isset($user->name) ? $user->name : ''}}" >                  
                </div>
            </div>

            <div class="form-group">
                <div class="form-label">
                    <label>Correo:</label>
                </div>
                <div class="form-input" id="question">
                    <input type="email" class="input" name="email" value="{{isset($user->email) ? $user->email : ''}}" >
                </div>
            </div>

            <div class="form-group">
                <div class="form-label">
                    <label >Contraseña:</label> 
                </div>
                <div class="form-input">
                    <input type="password" class="input" name="password" value="{{isset($user->password) ? $user->password : ''}}" >
                </div>
            </div>

            <div class="form-group">
                <div class="form-label">
                    <label >Confirmar Contraseña:</label> 
                </div>
                <div class="form-input">
                    <input type="password" class="input" name="confirm_password" value="{{isset($user->password) ? $user->password : ''}}" >
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
