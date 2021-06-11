@extends('front.layout.header-section')

@section("content")

    <h2 class="title"> @lang('front/faqs.title')</h2>  

    <div class="login-form">

        <form class="login" id="login" method="POST" action="{{route('front_login_submit')}}" autocomplete="off">
    
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
    
            <div class="form-sesion">
                <button class="form-button" id="save-button">
                    Iniciar Sesión
                </button>
            </div>
        </form>
    

    </div>
           


@endsection