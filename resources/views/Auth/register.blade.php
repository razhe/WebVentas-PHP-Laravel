@extends('Auth.masterAuth')

@section('title')
    Registrese
@endsection

@section('content')

<main class="main__auth">
    <!--HTML Collective-->
    <div class="box shadow-sm">
        <div class="header__auth">
            <a href="{{ url('/') }}">
                <img class="logo__auth" src="{{ url('/static/images/logo.png') }}" alt="logo empresa">
            </a>
        </div>
        <form class="register__form" action="{{url('/register')}}" id="register-form" method="post">
            @csrf
            <div class="row m-0 g-0">
                <!--nombre-->    
                <div class="input__container col-lg-6 col-md-6 p-1">    
                    <div class="default-input-form">
                        <input type="text" name="name" id="name_register" placeholder="Nombre" class="inpt-default-form" required>
                        <i class="fa-solid fa-user"></i>
                        <div id="error_name_register" class="error_default_input"></div>
                    </div>
                </div>
                <!--apellido-->    
                <div class="input__container col-lg-6 col-md-6 p-1">    
                    <div class="default-input-form">
                        <input type="text" name="last_name" id="last_name_register"  placeholder="Apellido" class="inpt-default-form" required>
                        <i class="fa-solid fa-user"></i>
                        <div id="error_last_name_register" class="error_default_input"></div>
                    </div>
                </div>
            </div>
            <!--phone-->    
            <div class="input__container input__container__phone p-1">
                <div class="select-phone">
                    <select name="phone_code" id="select_phone_register">
                        <option value="569">+569</option>
                        <option value="562">+562</option>
                    </select>  
                </div>  
                
                <div class="default-input-form">
                    <input type="text" name="phone" id="phone_register"  placeholder="Teléfono" class="inpt-default-form" required>
                    <i class="fa-solid fa-mobile-screen"></i>
                    <div id="error_phone_register" class="error_default_input"></div>
                </div>
            </div>
            <!--Email-->    
            <div class="input__container p-1">    
                <div class="default-input-form">
                    <input type="email" name="email" id="email_register"  placeholder="Correo" class="inpt-default-form" required>
                    <i class="fa-solid fa-envelope"></i>
                    <div id="error_email_register" class="error_default_input"></div>
                </div>
            </div>
            <!--Contraseña-->
            <div class="input__container p-1">                                   
                <div class="default-input-form">
                    <input type="password" name="password" placeholder="Contraseña" id="password_register" class="inpt-default-form" required>
                    <i class="fa-solid fa-key"></i>
                    <div id="error_password_register" class="error_default_input"></div>
                </div>
            </div>

            <!--Confirmación Contraseña-->
            <div class="input__container p-1">                                   
                <div class="default-input-form">
                    <input type="password" name="cpassword" placeholder="Confirmación contraseña" id="cpassword_register" class="inpt-default-form" required>
                    <i class="fa-solid fa-key"></i>
                    <div id="error_cpassword_register" class="error_default_input"></div>
                </div>
            </div>
            <button type="submit" name="registrarse" id="btn-register" class="btn-default-yellow">Registrar cuenta</button>
        </form>
        <!--Validacion formulario-->
        @if(Session::has('MsgResponse'))
            <div class="container box-msgAuth-error">
                <div class="alert alert-{{ Session::get('typealert') }}" style="display:none;">
                {{Session::get('MsgResponse')}}
                @if($errors -> any())
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
                <script>
                    $('.alert').slideDown();
                    setTimeout(function() {$('.alert').slideUp();}, 8000);
                </script>
                </div>
            </div>
        @endif

        <div class="register__text">
            <p>¿Ya posee una cuenta? </p><a href="{{ url('/login') }}">Inicie sesión Aquí</a>
        </div>
    </div>
</main>
    
@endsection <!--Declarar el fin de la seccion-->
@section('JS')
    <script src="{{url('static/js/register-auth.js')}}"></script>
@endsection