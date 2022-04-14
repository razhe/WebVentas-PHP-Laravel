@extends('Auth.masterAuth')

@section('title','Recuperar contraseña')

@section('content')
<main class="main__auth">
    <div class="box shadow-sm">
        <div class="header__auth">
            <a href="{{ url('/') }}">
                <img class="logo__auth" src="{{ url('/static/images/logo.png') }}" alt="logo-empresa">
            </a>
        </div>
        <form action="{{url('/change-password')}}" method="post">
            @csrf
            <!--Email-->    
            <div class="input__container">    
                <div class="default-input-form">
                    <input type="hidden" name="email" placeholder="Correo" id="email" value="{{Session::get('email')}}" class="inpt-default-form" required>
                    <i class="fa-solid fa-envelope"></i>
                    <div id="error_email_user" class="error_default_input"></div>
                </div>
            </div>

            <!--Contraseña-->
            <div class="input__container">                                   
                <div class="default-input-form">
                    <input type="password" name="password" placeholder="Nueva contraseña" id="password_change" class="inpt-default-form" required>
                    <i class="fa-solid fa-key"></i>
                    <div id="error_password_user" class="error_default_input"></div>
                </div>
            </div>

            <!--Confirmación Contraseña-->
            <div class="input__container">                                   
                <div class="default-input-form">
                    <input type="password" name="cpassword" placeholder="Confirmación contraseña" id="cpassword_change" class="inpt-default-form" required>
                    <i class="fa-solid fa-key"></i>
                    <div id="error_password_user" class="error_default_input"></div>
                </div>
            </div>
            <button type="submit" name="" id="" class="btn-default-yellow">Actualizar contraseña</button>
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
            <a href="{{ url('/login') }}">Ingresar a mi cuenta</a>
        </div> 

    </div>
</main>
@endsection