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
        <form action="{{url('/login')}}" method="post" class="login__form needs-validation" novalidate>
            @csrf
            <!--Email-->    
            <div class="input__container">
                <label for="correo">Correo electrónico:</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="bi bi-envelope"></i>
                    </span>
                    <input type="email" name="email" class="form-control" required>
                </div>
            </div>
            <!--Contraseña-->
            <div class="input__container">
                <label for="contraseña">Contraseña:</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="bi bi-shield-lock"></i>
                    </span>
                    <input type="password" name="password" class="form-control" required>
                </div>
            </div>
            <input type="submit" name="loguearse" id="" class="btn btn-success">
        </form>
        
        <!--Validacion formulario-->
        @if(Session::has('authMsgError'))
            <div class="container box-msgAuth-error">
                <div class="alert alert-{{ Session::get('typealert') }}" style="display:none;">
                {{Session::get('authMsgError')}}
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
    
@stop <!--Declarar el fin de la seccion-->