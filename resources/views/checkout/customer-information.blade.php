@extends('checkout.layout')
@section('title', 'Datos del comprador')

@section('CSS')
    <!--CSS-->
        <link rel="stylesheet" href="{{url('static/css/checkout-customers.css')}}">
@endsection

@section('content')
<section class="step-wizard">
    <ul class="step-wizard-list">
        <li class="step-wizard-item current-item">
            <span class="progress-count">1</span>
            <span class="progress-label">Datos del comprador</span>
        </li>
        <li class="step-wizard-item">
            <span class="progress-count">2</span>
            <span class="progress-label">Formas de pago</span>
        </li>
        <li class="step-wizard-item">
            <span class="progress-count">3</span>
            <span class="progress-label">Resumen y Pago</span>
        </li>
        <li class="step-wizard-item">
            <span class="progress-count">4</span>
            <span class="progress-label">Detalle de compra</span>
        </li>
    </ul>
</section>
<section class="checkout-content">
    <div class="checkout_container">
        <div class="box-checkout">
            <div class="box-title">
                <h4>Datos del comprador</h4>
            </div>
            @if (Auth::guest())
                <div class="box-contenido">
                    <div class="box-usuario-visitante">
                        <div class="title_collapse">
                            <h4>Poseo una cuenta</h4>
                        </div>
                        <div class="contenido_usuario_visitante posee_cuenta">
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
                                <input type="hidden" name="estance" value="checkout">
                                <input type="submit" name="loguearse" id="" class="btn btn-success">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="box-contenido">
                    <div class="box-usuario-visitante">
                        <div class="title_collapse">
                            <h4>Compra rápida</h4>
                        </div>
                        <div class="contenido_usuario_visitante compra_rapida">
                            <span>Este método no te permitirá listar luego tus compras en nuestro portal.</span>
                            <input type="text" placeholder="Nombre">
                            <input type="text" placeholder="apellido">
                            <input type="text" placeholder="Teléfono">
                            <input type="text" placeholder="Email">
                                <!--direccion-->
                                <div class="input__container mt-1">
                                <label for="phone">Dirección:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="bi bi-compass"></i>
                                    </span>
                                    <input type="text" placeholder="Ej. Número, pasaje, calle/avenida" value="" name="address" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group mt-1">
                                <label for="inputState">Recidencia:</label>
                                <select id="inputState" name="residency" class="form-control form-select" aria-label="Default select example">
                                    <option selected disabled>Seleccione:</option>
                                    <option value="8976">Casa</option>
                                    <option value="4932">Departamento</option>
                                    <option value="3456">Recinto empresarial</option>
                                </select>
                            </div>
                            
                            <div class="row m-0 g-0">
                                <!--region-->
                                <div class="form-group col-lg-6 col-md-6 mt-1">
                                    <label for="inputState">Región:</label>
                                    <select id="select-region" name="region" class="form-control form-select" aria-label="Default select example">
                                        <option value="region-metropolitana" selected>Region Metropolitana</option>
                                    </select>
                                </div>
                                <!--comuna-->
                                <div class="form-group col-lg-6 col-md-6 mt-1">
                                    <label for="inputState">Comuna:</label>
                                    <select id="select-comuna" name="comuna" class="form-control form-select" aria-label="Default select example">
                                        <option selected disabled>Seleccione una región:</option>
                                    </select>
                                </div>
                            </div>
                            <span>*Por el momento los envíos solo están disponibles para la región metropolitana.</span>
                            <button>Ingresar</button>
                        </div>
                    </div>
                </div>
            @else
                <div class="box-contenido">
                    <div class="box-usuario-logueado">
                        <div class="titulo_logueado">
                            <h4>Su información</h4>
                        </div>
                        <div class="contenido_usuario_logueado">
                            <p>Nombre completo: {{Auth::user()-> name . ' ' .Auth::user()-> last_name}}</p>
                            <p>Email: {{Auth::user()-> email}}</p>
                            <p>teléfono: {{Auth::user()-> phone}}</p>
                            @if (count($address) == 1)
                                <p>Dirección: {{$address[0] -> address .'('.$address[0] -> residency .')' .', '.$address[0] -> comuna_name .', '.$address[0] -> region_name .'.'}}</p>
                                <div class="opciones_usuario_logueado">
                                </div>
                            @else
                                <label for="radio_boleta" class="label_radio_documento">
                                    <input type="radio" id="radio_direccion1" class="" name="direccion">
                                    <div class="radio__radio">Direccion 1: 
                                        <p>{{$address[0] -> address .'('.$address[0] -> residency .')' .', '.$address[0] -> comuna_name .', '.$address[0] -> region_name .'.'}}</p>
                                    </div>
                                </label>
                                <label for="radio_boleta" class="label_radio_documento">
                                    <input type="radio" id="radio_direccion2" class="" name="direccion">
                                    <div class="radio__radio"> Direccion 2:
                                        <p>{{$address[1] -> address .'('.$address[1] -> residency .')' .', '.$address[1] -> comuna_name .', '.$address[1] -> region_name .'.'}}</p>
                                    </div>
                                </label>
                            @endif
                            <a href="{{url('/profile')}}">Modificar</a>
                        </div>
                    </div>
                </div>
            @endif
            <button class="">Siguiente</button>
        </div>
    </div>
</section>
@endsection

@section('JS')
    
@endsection