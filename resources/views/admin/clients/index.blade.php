@extends('admin.layout.table_form')

@section('table')

    <div class="table-container">

        <table>

            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                    <th>CP</th>
                    <th>Teléfono</th>
                    <th></th>     
                </tr>
            </thead>

            @foreach ($clients as $client_element)
                <tbody>
                    <tr class="saved-faq">
                        <td id="id">{{$client_element->id}}</td>
                        <td id="name">{{$client_element->name}}</td>
                        <td id="email">{{$client_element->email}}</td>
                        <td id="adress">{{$client_element->adress}}</td>
                        <td id="postcode">{{$client_element->postcode}}</td>
                        <td id="telephone">{{$client_element->telephone}}</td>  
                        <td class="table-buttons">

                            <div class="edit-button">
                                <button class="edit-buttons" id="edit" data-url="{{route('clients_show', ['clients' => $client_element->id])}}">
                                    <svg style="width:24px;height:24px" viewBox="0 0 24 24" class="plus-button">
                                        <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                                    </svg>
                                </button>
                            </div>

                            <div class="eliminate-button">
                                <button class="eliminate-buttons" id="eliminate" data-url="{{route('clients_destroy', ['clients' => $client_element->id])}}">
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
                                                  
                              
    <form class="admin-form" id="faqs-form" action="{{route("clients_store")}}" autocomplete="off">
    
        <input autocomplete="false" name="hidden" type="text" style="display:none;">
        <input type="hidden" name="id" value="{{isset($client->id) ? $client->id : ''}}">
                        
        {{ csrf_field() }}

        <div class="form-parts">
            <div class="part" data-part="part1">Parte 1</div>
            <div class="part" data-part="part2">Parte 2</div>
            <div class="part" data-part="part3">Parte 3</div>
        </div>

        <div class="form-part-section active" data-part="part1">
            <div class="form-group">
                <div class="form-label">
                    <label>Nombre:</label>
                </div>
                <div class="form-input" id="question">
                    <input type="text" class="input" name="name" value="{{isset($client->name) ? $client->name : ''}}" >
                </div>
            </div>

            <div class="form-group">
                <div class="form-label">
                    <label>Correo:</label>
                </div>
                <div class="form-input" id="question">
                    <input type="email" class="input" name="email" value="{{isset($client->email) ? $client->email : ''}}" >
                </div>
            </div>

            <div class="form-group">
                <div class="form-label">
                    <label>País:</label>
                </div>
                <div class="form-input" id="question">
                    <select name="country" class="input">
                        <option></option>
                        @foreach ($countries as $country)
                            <option value="{{$country->id}}" {{$client->country == $country->id ? "selected" : ""}}>{{$country->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-part-section" data-part="part2">

            <div class="form-group">
                <div class="form-label">
                    <label>Provincia:</label>
                </div>
                <div class="form-input" id="question">
                    <input type="text" class="input" name="region" value="{{isset($client->region) ? $client->region : ''}}" >
                </div>
            </div>

            <div class="form-group">
                <div class="form-label">
                    <label>Población:</label>
                </div>
                <div class="form-input" id="question">
                    <input type="text" class="input" name="town" value="{{isset($client->town) ? $client->town : ''}}" >
                </div>
            </div>

            <div class="form-group">
                <div class="form-label">
                    <label>Dirección:</label>
                </div>
                <div class="form-input" id="question">
                    <input type="text" class="input" name="adress" value="{{isset($client->adress) ? $client->adress : ''}}" >
                </div>
            </div>
        </div>

        <div class="form-part-section" data-part="part3">
            <div class="form-group">
                <div class="form-label">
                    <label>CP:</label>
                </div>
                <div class="form-input" id="question">
                    <input type="text" class="input" name="postcode" value="{{isset($client->postcode) ? $client->postcode : ''}}" >
                </div>
            </div>

            <div class="form-group">
                <div class="form-label">
                    <label>Teléfono:</label>
                </div>
                <div class="form-input" id="question">
                    <input type="tel" class="input" name="telephone" value="{{isset($client->telephone) ? $client->telephone : ''}}" >
                </div>
            </div>
        </div class="form-part-section">

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
