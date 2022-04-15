@extends('Auth.masterAuth')

@section('title','Inicio sesión')

@section('content')
<main class="main__auth">
    <!--HTML Collective-->
    <div class="box shadow-sm">
        <div class="header__auth">
            <a href="{{ url('/') }}">
                <img class="logo__auth" src="{{ url('/static/images/logo.png') }}" alt="logo-empresa">
            </a>
        </div>
        <form action="{{url('/login')}}" method="post" class="login__form" id="login-form">
            @csrf
            <!--Email-->    
            <div class="input__container">    
                <div class="default-input-form">
                    <input type="email" name="email" placeholder="Correo" id="email_login" class="inpt-default-form" required>
                    <i class="fa-solid fa-envelope"></i>
                    <div id="error_email_login" class="error_default_input"></div>
                </div>
            </div>
            <!--Contraseña-->
            <div class="input__container">                                   
                <div class="default-input-form">
                    <input type="password" name="password" placeholder="Contraseña" id="password_login" class="inpt-default-form" required>
                    <i class="fa-solid fa-key"></i>
                    <div id="error_password_login" class="error_default_input"></div>
                </div>
            </div>
            <button type="submit" name="" id="btn-login" class="btn-default-yellow mt-2">Iniciar sesión</button>
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
            <p>¿Aún no estas registrado? </p><a href="{{ url('/register') }}">Registrese Aquí</a>
        </div>
        <div class="recover__text">
            <a href="{{ url('/recover') }}">¿Olvidaste tu contraseña?</a>
        </div>

    </div>
</main>
    
@endsection <!--Declarar el fin de la seccion-->

@section('JS')
    <script src="{{url('static/js/login-auth.js')}}"></script>
@endsection