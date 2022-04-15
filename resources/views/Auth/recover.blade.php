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
        <form action="{{url('/recover')}}" method="post" class="" id="recover-password-form">
            @csrf
            <!--Email-->    
            <div class="input__container">    
                <div class="default-input-form">
                    <input type="email" name="email" placeholder="Correo" id="email" class="inpt-default-form">
                    <i class="fa-solid fa-envelope"></i>
                    <div id="error_email_recoverpass" class="error_default_input"></div>
                </div>
            </div>
            <button type="submit" name="" id="btn-recover-password" class="btn-default-yellow mt-2">Recuperar contraseña</button>
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
    <script src="{{url('static/js/recover.js')}}"></script>
@endsection