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
        <form class="register__form needs-validation" action="{{url('/register')}}" method="post" novalidate>
            @csrf
            <!--Nombre-->
            <div class="2-columns-row row">
                <div class="input__container col-md-6">
                    <label for="name">Nombre:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="bi bi-person"></i>
                        </span>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                </div>
                <!--Apellido-->
                <div class="input__container col-md-6">
                    <label for="last_name">Apellido:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="bi bi-person-fill"></i>
                        </span>
                        <input type="text" name="last_name" class="form-control" required>
                    </div>
                </div>
            </div>
            <!--Telefono-->
            <div class="input__container">
                <label for="phone">Numero telefónico:</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="bi bi-telephone"></i>
                    </span>
                    <input type="text" name="phone" class="form-control" required>
                </div>
            </div>
            <!--Email-->
            <div class="input__container">
                <label for="email">Correo electrónico:</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="bi bi-envelope"></i>
                    </span>
                    <input type="email" name="email" class="form-control" required>
                </div>
            </div>
            <!--Contraseña-->
            <div class="input__container">
                <label for="password">Contraseña:</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="bi bi-shield-lock"></i>
                    </span>
                    <input type="password" name="password" class="form-control" required>
                </div>
            </div>
            <!--Contraseña 2-->
            <div class="input__container">
                <label for="cpassword">Confirme contraseña:</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="bi bi-shield-lock-fill"></i>
                    </span>
                    <input type="password" name="cpassword" class="form-control" required>
                </div>
            </div>
            <input type="submit" name="registrarse" id="" class="btn btn-success">
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
            <p>¿Ya posee una cuenta? </p><a href="{{ url('/login') }}">Inicie sesión Aquí</a>
        </div>
    </div>
</main>
    
@stop <!--Declarar el fin de la seccion-->
