@extends('front.layout.header-content')

@section("login")
    <div class="login-title">
        <h3>Inicio de Sesión</h2>
    </div>
    <div class="login-form">

        <form class="admin-form" id="faqs-form" method="POST" action="{{route('front_login_submit')}}" autocomplete="off">
    
            <input autocomplete="false" name="hidden" type="text" style="display:none;">
            <input type="hidden" name="id" value="{{isset($user->id) ? $user->id : ''}}">
                            
            {{ csrf_field() }}
            <div class=form>

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
    

    </div>
           


@endsection