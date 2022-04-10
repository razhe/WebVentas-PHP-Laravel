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
<section class="checkout-content">
    <div class="checkout_container">
        <div class="box-checkout">
            <div class="box-title">
                <h4>Datos del comprador</h4>
                <div class="hline"></div>
            </div>
            
            @if (Auth::guest())
            <div class="container-opt-compras">
                <div class="box-contenido">
                    <div class="box-usuario-visitante">
                        <div class="title_collapse">
                            <div class=""><span>1</span></div>
                            <h4>Poseo una cuenta</h4>
                        </div>
                        <div class="contenido_usuario_visitante posee_cuenta">
                            <form action="{{url('/login')}}" method="post" class="login__form needs-validation" novalidate>
                                @csrf
                                <!--Email-->    
                                <div class="input__container">    
                                    <div class="default-input-form">
                                        <label for="email">Correo electrónico</label>
                                        <input type="email" name="email" class="inpt-default-form" required>
                                        <div class="underline"></div> 
                                    </div>
                                </div>
                                <!--Contraseña-->
                                <div class="input__container">
                                    
                                    <div class="default-input-form">
                                        <label for="email">Contraseña</label> 
                                        <input type="password" name="password" class="inpt-default-form" required>
                                        <div class="underline"></div> 
                                    </div>
                                </div>
                                <input type="hidden" name="estance" value="{{Crypt::encryptString('checkout')}}">
                                <input type="submit" name="loguearse" id="" class="btn btn-success">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="box-contenido">
                    <div class="box-usuario-visitante">
                        <div class="title_collapse">
                            <div class=""><span>2</span></div>
                            <h4>No poseo cuenta</h4>
                        </div>
                        <div class="contenido_usuario_visitante compra_rapida">
                            <form action="{{url('/checkout/save-guest-data')}}" id="form-save-guest" method="post">
                                @csrf
                                <span>Si no desea volver a escribir sus datos en la página web puede <a href="{{url('/register')}}">registrarse</a>.</span>
                                <input type="text" placeholder="Nombre" name="name">
                                <input type="text" placeholder="apellido" name="last_name">
                                <input type="text" placeholder="Teléfono" name="phone">
                                <input type="text" placeholder="Email" name="email">
                                <!--direccion-->
                                <div class="input__container mt-1">
                                    <label for="address">Dirección:</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="bi bi-compass"></i>
                                        </span>
                                        <input type="text" placeholder="Ej. Número, pasaje, calle/avenida" value="" name="address" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group mt-1">
                                    <label for="residency">Recidencia:</label>
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
                                        <label for="region">Región:</label>
                                        <select id="select-region" name="region" class="form-control form-select" aria-label="Default select example">
                                            <option value="region-metropolitana" selected>Region Metropolitana</option>
                                        </select>
                                    </div>
                                    <!--comuna-->
                                    <div class="form-group col-lg-6 col-md-6 mt-1">
                                        <label for="comuna">Comuna:</label>
                                        <select id="select-comuna" name="comuna" class="form-control form-select" aria-label="Default select example">
                                            <option selected disabled>Seleccione una región:</option>
                                        </select>
                                    </div>
                                </div>
                                <span>*Por el momento los envíos solo están disponibles para la región metropolitana.</span>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="container-btn-next">
                    <button class="btn-default-yellow" id="btn-go-payment-guest">Siguiente</button>
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
                            <form action="{{url('/checkout/save-user-data')}}" id="form-save-user" method="post">
                                @csrf
                                @if (count($address) == 1)
                                    <p>Dirección: {{$address[0] -> address .'('.$address[0] -> residency .')' .', '.$address[0] -> comuna_name .', '.$address[0] -> region_name .'.'}}</p>
                                    <input type="hidden" name="direccion" value="{{Crypt::encryptString($address[0] -> id)}}">
                                    <div class="opciones_usuario_logueado">
                                    </div>
                                @endif
                                @if (count($address) > 1)
                                    <label for="radio_boleta" class="label_radio_documento">
                                        <input type="radio" id="radio_direccion1" class="" name="direccion" value="{{Crypt::encryptString($address[0] -> id)}}">
                                        <div class="radio__radio">Direccion 1: 
                                            <p>{{$address[0] -> address .'('.$address[0] -> residency .')' .', '.$address[0] -> comuna_name .', '.$address[0] -> region_name .'.'}}</p>
                                        </div>
                                    </label>
                                    <label for="radio_boleta" class="label_radio_documento">
                                        <input type="radio" id="radio_direccion2" class="" name="direccion" value="{{Crypt::encryptString($address[1] -> id)}}">
                                        <div class="radio__radio"> Direccion 2:
                                            <p>{{$address[1] -> address .'('.$address[1] -> residency .')' .', '.$address[1] -> comuna_name .', '.$address[1] -> region_name .'.'}}</p>
                                        </div>
                                    </label>
                                @endif
                                @if (count($address) == 0)
                                    <a href="{{url('/profile')}}">registrar direcciones</a>
                                @endif
                            </form>
                            <a href="{{url('/profile')}}">Modificar</a>
                        </div>
                    </div>
                </div>
                <button class="btn-next-step" id="btn-go-payment-user">Siguiente</button>
            @endif
        </div>
    </div>
</section>
@endsection

@section('JS')
    <script src="{{url('static/js/customer-information.js')}}"></script>
@endsection