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
                        <div class="contenido_usuario posee_cuenta">
                            <div class="box-form">
                                <form action="{{url('/login')}}" method="post" class="login__form needs-validation" novalidate>
                                    @csrf
                                    <!--Email-->    
                                    <div class="input__container">    
                                        <div class="default-input-form">
                                            <input type="email" name="email" placeholder="Correo" class="inpt-default-form" required>
                                            <i class="fa-solid fa-envelope"></i>
                                        </div>
                                    </div>
                                    <!--Contraseña-->
                                    <div class="input__container">                                   
                                        <div class="default-input-form">
                                            <input type="password" name="password" placeholder="Contraseña" class="inpt-default-form" required>
                                            <i class="fa-solid fa-key"></i>
                                        </div>
                                    </div>
                                    <input type="hidden" name="estance" value="{{Crypt::encryptString('checkout')}}">
                                    <button type="submit" name="loguearse" class="btn-default-yellow mt-3">Iniciar sesión </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-contenido">
                    <div class="box-usuario-visitante">
                        <div class="title_collapse">
                            <div class=""><span>2</span></div>
                            <h4>No poseo cuenta</h4>
                        </div>
                        <div class="contenido_usuario compra_rapida">
                            <div class="box-form">
                                <form action="{{url('/checkout/save-guest-data')}}" id="form-save-guest" method="post">
                                    @csrf
                                    <span class="tag-min-advertencia">Si no desea volver a escribir sus datos en la página web puede <a href="{{url('/register')}}">registrarse</a>.</span>
                                    <div class="row m-0 g-0">
                                        <!--nombre-->    
                                        <div class="input__container col-lg-6 col-md-6 p-1">    
                                            <div class="default-input-form">
                                                <input type="text" name="name" id="name_guest" placeholder="Nombre" class="inpt-default-form" required>
                                                <i class="fa-solid fa-user"></i>
                                                <div id="error_name" class="error_default_input"></div>
                                            </div>
                                        </div>
                                        <!--apellido-->    
                                        <div class="input__container col-lg-6 col-md-6 p-1">    
                                            <div class="default-input-form">
                                                <input type="text" name="last_name" id="last_name_guest"  placeholder="Apellido" class="inpt-default-form" required>
                                                <i class="fa-solid fa-user"></i>
                                                <div id="error_last_name" class="error_default_input"></div>
                                            </div>
                                        </div>
                                    </div>
                
                                    <!--phone-->    
                                    <div class="input__container p-1">    
                                        <div class="default-input-form">
                                            <input type="text" name="phone" id="phone_guest"  placeholder="Teléfono" class="inpt-default-form" required>
                                            <i class="fa-solid fa-mobile-screen"></i>
                                            <div id="error_phone" class="error_default_input"></div>
                                        </div>
                                    </div>
                                    <!--Email-->    
                                    <div class="input__container p-1">    
                                        <div class="default-input-form">
                                            <input type="email" name="email" id="email_guest"  placeholder="Correo" class="inpt-default-form" required>
                                            <i class="fa-solid fa-envelope"></i>
                                            <div id="error_email" class="error_default_input"></div>
                                        </div>
                                    </div>
                                    <!--direccion-->    
                                    <div class="input__container p-1">    
                                        <div class="default-input-form">
                                            <input type="text" name="address" id="address_guest"  placeholder="Dirección" class="inpt-default-form" required>
                                            <i class="fa-solid fa-location-dot"></i>
                                            <div id="error_address" class="error_default_input"></div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-1 p-1">
                                        <select name="residency" id="residency_guest"  class="form-control form-select" aria-label="Default select example">
                                            <option selected value="" disabled>Residencia...</option>
                                            <option value="8976">Casa</option>
                                            <option value="4932">Departamento</option>
                                            <option value="3456">Recinto empresarial</option>
                                        </select>
                                        <div id="error_residency" class="error_default_input"></div>
                                    </div>
                                    
                                    <div class="row m-0 g-0">
                                        <!--region-->
                                        <div class="form-group col-lg-6 col-md-6 mt-1 p-1">
                                            <select name="region" id="region_guest" class="form-control form-select" aria-label="Default select example">
                                                <option value="region-metropolitana" selected>Region Metropolitana</option>
                                            </select>
                                            <div id="error_region" class="error_default_input"></div>
                                        </div>
            
                                        <!--comuna-->
                                        <div class="form-group col-lg-6 col-md-6 mt-1 p-1">
                                            <select name="comuna" id="comuna_guest"  class="form-control form-select" aria-label="Default select example">
                                            </select>
                                            <div id="error_comuna" class="error_default_input"></div>
                                        </div>
                                    </div>
                                    <span class="tag-min-advertencia mt-2">*Por el momento los envíos solo están disponibles para la región metropolitana.</span>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-btn-next">
                    <button class="btn-default-yellow" id="btn-go-payment-guest">Siguiente <i class="fa-solid fa-arrow-right-long"></i></button>
                </div>
                
            </div>
            @else
                <div class="box-contenido">
                    <div class="box-usuario-logueado">
                        <div class="contenido_usuario_logueado">
                            <p>Nombre: {{Auth::user()-> name . ' ' .Auth::user()-> last_name}}</p>
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
                                    <p><strong>¿Donde quieres que llevemos tu pedido?</strong></p>
                                    <div class="box-direccion">
                                        <label for="radio_direccion1" class="label_radio_documento">
                                            <input type="radio" id="radio_direccion1" class="" name="direccion" value="{{Crypt::encryptString($address[0] -> id)}}">
                                            <div class="radio__radio">
                                                <div class="icon-selected"><i class="fa-solid fa-check"></i></div>
                                                <p><strong>Dirección 1</strong></p>
                                                <p>{{$address[0] -> address .'('.$address[0] -> residency .')' .', '.$address[0] -> comuna_name .', '.$address[0] -> region_name .'.'}}</p>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="box-direccion">
                                        <label for="radio_direccion2" class="label_radio_documento">
                                            <input type="radio" id="radio_direccion2" class="" name="direccion" value="{{Crypt::encryptString($address[1] -> id)}}">
                                            <div class="radio__radio"> 
                                                <div class="icon-selected"><i class="fa-solid fa-check"></i></div>
                                                <p><strong>Dirección 2</strong></p>
                                                <p>{{$address[1] -> address .'('.$address[1] -> residency .')' .', '.$address[1] -> comuna_name .', '.$address[1] -> region_name .'.'}}</p>
                                            </div>
                                        </label>
                                    </div>
                                @endif
                                @if (count($address) == 0)
                                    <a href="{{url('/profile')}}">registrar direcciones</a>
                                @endif
                            </form>
                            <div class="editar-link">
                                <a href="{{url('/profile')}}">Editar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn-default-yellow" id="btn-go-payment-user">Siguiente <i class="fa-solid fa-arrow-right-long"></i></button>
            @endif
        </div>
    </div>
</section>
@endsection

@section('JS')
    <script src="{{url('static/js/customer-information.js')}}"></script>
@endsection