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
        <form action="{{url('/reset')}}" method="post" id="reset-password-form" class="" >
            @csrf
            <!--Email-->    
            <div class="input__container">
                <div class="input-group">
                    <input id="email" type="hidden" name="email" value="{{$email}}" class="form-control" required>
                </div>
            </div>
            <!--Codigo-->    
            <div class="input__container">    
                <div class="default-input-form">
                    <input type="text" name="password_code" placeholder="Código de recuperación" id="codigo" class="inpt-default-form" required>
                    <i class="fa-solid fa-envelope"></i>
                    <div id="error_codigo_reset" class="error_default_input"></div>
                </div>
            </div>
            <button type="submit" name="" id="btn-reset-password" class="btn-default-yellow mt-2">Validar código</button>
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
@section('JS')
    <script src="{{url('static/js/reset-password.js')}}"></script>
@endsection