@extends('layout')

@section('CSS')
    <!--Css-->
        <link rel="stylesheet" href="{{url('static/css/profile.css')}}">
    <!--JS-->
        <!--JQuery-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('title', 'Perfil')

@section('content')
    <div class="main-perfil">
        <div class="contenedor-alerta">
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
        </div>
        <div class="contenedor-perfil">
            <div class="navegacion-perfil">
                <div class="item-navegacion">
                    <button id="pefil-principal" class="boton-seccion-perfil"><i class="bi bi-person-bounding-box"></i><span>Perfil</span></button>
                </div>
                <div class="item-navegacion">
                    <button id="pefil-contraseña" class="boton-seccion-perfil"><i class="bi bi-shield-lock"></i><span>Contraseña</span></button>
                </div>
            </div>
            <div class="contenido-perfil">
                <div id="box-perfil-principal" class="box-perfil-principal box-contenido activo">
                    <h4>¡Hola: nombre!</h4>
                    <form class="register__form needs-validation" action="{{url('/profile/update-profile')}}" method="post" novalidate>
                        @csrf
                        <input type="hidden" name="codigo_usuario" value="{{Auth::user()-> id}}">
                        <!--Nombre-->
                        <div class="2-columns-row row mt-1">
                            <div class="input__container col-md-6">
                                <label for="name">Nombre:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input type="text" value="{{Auth::user() -> name}}" name="name" class="form-control" required>
                                </div>
                            </div>
                            <!--Apellido-->
                            <div class="input__container col-md-6">
                                <label for="last_name">Apellido:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="bi bi-person-fill"></i>
                                    </span>
                                    <input type="text" value="{{Auth::user() -> last_name}}" name="last_name" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <!--Telefono-->
                        <div class="input__container mt-1">
                            <label for="phone">Numero telefónico:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="bi bi-telephone"></i>
                                </span>
                                <input type="text" value="{{Auth::user() -> phone}}" name="phone" class="form-control" required>
                            </div>
                        </div>
                        <!--Email-->
                        <div class="input__container mt-1">
                            <label for="email">Correo electrónico:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input type="email" value="{{Auth::user() -> email}}" name="email" class="form-control" disabled>
                            </div>
                        </div>
                        
                        <!--direccion-->
                        <div class="input__container mt-1">
                            <label for="address">Dirección:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="bi bi-signpost"></i>
                                </span>
                                <input type="text" value="{{Auth::user() -> address}}" name="address" class="form-control">
                            </div>
                        </div>
                        <input type="submit" name="editar" value="Actualizar Perfil" class="btn btn-success mt-3">
                    </form>
                </div>
                <div id="box-contraseña" class="box-contraseña box-contenido">
                    <h4>Cambiar contraseña</h4>
                    <form class="register__form needs-validation" action="{{url('/profile/update-password')}}" method="post" novalidate>
                        @csrf
                        <!--Contraseña actual-->
                        <div class="input__container mt-2">
                            <label for="apassword">Contraseña actual:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="bi bi-key"></i>
                                </span>
                                <input type="password" name="apassword" class="form-control" required>
                            </div>
                        </div>

                        <div class="input__container mt-2">
                            <label for="password">Nueva contraseña:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="bi bi-shield-lock"></i>
                                </span>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                        <!--Contraseña 2-->
                        <div class="input__container mt-2">
                            <label for="cpassword">Confirme contraseña:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="bi bi-shield-lock-fill"></i>
                                </span>
                                <input type="password" name="cpassword" class="form-control" required>
                            </div>
                        </div>
                        <input type="submit" name="actualizar_contraseña" value="Actualizar contraseña" class="btn btn-success mt-4">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('JS')
    <!--JS-->
        <script src="{{url('static/js/profile.js')}}"></script>
@endsection