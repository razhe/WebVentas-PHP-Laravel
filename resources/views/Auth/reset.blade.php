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
        <form action="{{url('/reset')}}" method="post" class="needs-validation" novalidate>
            @csrf
            <!--Email-->    
            <div class="input__container">
                <div class="input-group">
                    <input id="email" type="hidden" name="email" value="{{$email}}" class="form-control" required>
                </div>
            </div>
            <!--Codigo-->    
            <div class="input__container">
                <label for="password_code">Código de recuperación:</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="bi bi-key"></i>
                    </span>
                    <input type="number" name="password_code" value="" class="form-control" required>
                </div>
            </div>
            <input type="submit" name="loguearse" value="Enviar Código" id="" class="btn btn-success">
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