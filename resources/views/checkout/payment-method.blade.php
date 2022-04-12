@extends('checkout.layout')
@section('title', 'Datos del comprador')

@section('CSS')
    <!--CSS-->
        <link rel="stylesheet" href="{{url('static/css/checkout-payment-method.css')}}">
@endsection

@section('content')
<section class="step-wizard">
    <ul class="step-wizard-list">
        <li class="step-wizard-item">
            <span class="progress-count">1</span>
            <span class="progress-label">Datos del comprador</span>
        </li>
        <li class="step-wizard-item current-item">
            <span class="progress-count">2</span>
            <span class="progress-label">Formas de pago</span>
        </li>
        <li class="step-wizard-item">
            <span class="progress-count">3</span>
            <span class="progress-label">Resumen y Pago</span>
        </li>
    </ul>
</section>
<section class="checkout-content">
    <div class="facturacion_container">
        <div class="box-facturacion">
            <div class="box-title">
                <h4>Formas de pago</h4>
                <div class="hline"></div>
            </div>
            <div class="box-contenido">
                <div class="box-formas-pago">
                    <div class="titulo_formas_pago">
                        <h4>Elija una forma de pago</h4>
                    </div>
                    <label for="radio_webpay" class="label_radio_documento">
                        <input type="radio" id="radio_webpay" class="" name="payment-method" value="webpay">
                        <div class="radio__radio">
                            <div class="icon-selected"><i class="fa-solid fa-check"></i></div>
                            <img src="{{asset('img/pagina/logo-webpay.png')}}" alt="">
                        </div>
                    </label>
                </div>
            </div>
            <div class="box-contenido">
                <div class="titulo_formas_facturacion">
                    <h4>Documento de facturación</h4>
                    <p class="tag-min-advertencia">Porfavor seleccione una opción</p>
                </div>
                <div class="box-documento-emitir">
                    <div class="titulo_boleta" id="titulo-boleta">
                        <label for="radio_boleta" class="label_radio_documento">
                            <input type="radio" id="radio_boleta" class="radio-tipo-documento" name="tipo_documento" value="boleta">
                            <div class="radio__radio"><p>Boleta</p></div>
                        </label>
                    </div>
                    <div class="contenido_boleta">
                        <div class="box-contenido">
                            <!--Rut-->    
                            <div class="input__container p-1">    
                                <div class="default-input-form">
                                    <input type="text" name="rut_boleta" id="rut-boleta" placeholder="Rut" class="inpt-default-form" required>
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="titulo_factura" id="titulo-factura">
                    <label for="radio_factura" class="label_radio_documento">
                        <input type="radio" id="radio_factura" class="radio-tipo-documento" name="tipo_documento" value="factura">
                        <div class="radio__radio"><p>Factura</p></div>
                    </label>
                </div>
                <div class="contenido_factura">
                    <div class="box-contenido">
                        <div class="row m-0 g-0">
                            <!--Razon social-->    
                            <div class="input__container col-lg-6 col-md-6 p-1">    
                                <div class="default-input-form">
                                    <input type="text" name="razon_social" id="razon-social"  placeholder="Razon social" class="inpt-default-form" required>
                                    <i class="fa-solid fa-building"></i>
                                </div>
                            </div>
                            <!--Rut-->    
                            <div class="input__container col-lg-6 col-md-6 p-1">    
                                <div class="default-input-form">
                                    <input type="text" name="rut_factura" id="rut-factura"  placeholder="Rut empresa" class="inpt-default-form" required>
                                    <i class="fa-solid fa-user-tie"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0 g-0">
                            <!--Giro-->    
                            <div class="input__container col-lg-6 col-md-6 p-1">    
                                <div class="default-input-form">
                                    <input type="text" name="giro" id="giro"  placeholder="Giro" class="inpt-default-form" required>
                                    <i class="fa-solid fa-briefcase"></i>
                                </div>
                            </div>
                            <!--Ciudad-->    
                            <div class="input__container col-lg-6 col-md-6 p-1">    
                                <div class="default-input-form">
                                    <input type="text" name="ciudad" id="ciudad"  placeholder="Ciudad" class="inpt-default-form" required>
                                    <i class="fa-solid fa-city"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0 g-0">
                            <!--Comuna-->    
                            <div class="input__container col-lg-6 col-md-6 p-1">    
                                <div class="default-input-form">
                                    <input type="text" name="comuna" id="comuna"  placeholder="Comuna" class="inpt-default-form" required>
                                    <i class="fa-solid fa-map"></i>
                                </div>
                            </div>
                            <!--Telefono-->    
                            <div class="input__container col-lg-6 col-md-6 p-1">    
                                <div class="default-input-form">
                                    <input type="text" name="telefono" id="telefono"  placeholder="Teléfono" class="inpt-default-form" required>
                                    <i class="fa-solid fa-mobile-screen"></i>
                                </div>
                            </div>
                        </div>
                        <!--Direccion-->    
                        <div class="input__container p-1">    
                            <div class="default-input-form">
                                <input type="text" name="direccion" id="direccion"  placeholder="Dirección" class="inpt-default-form" required>
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn-default-yellow" id="btn-go-summary-payment">Siguiente <i class="fa-solid fa-arrow-right-long"></i></button>
        </div>
    </div>
</section>
@endsection

@section('JS')
    <script src="{{url('static/js/payment-method.js')}}"></script>
@endsection