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
        <li class="step-wizard-item">
            <span class="progress-count">4</span>
            <span class="progress-label">Detalle de compra</span>
        </li>
    </ul>
</section>
<section class="checkout-content">
    <div class="facturacion_container">
        <div class="box-facturacion">
            <div class="box-title">
                <h4>Formas de pago</h4>
            </div>
            <div class="box-contenido">
                <div class="box-formas-pago">
                    <div class="titulo_formas_pago">
                        <h4>Elija una forma de pago</h4>
                    </div>
                    <div class="contenido_formas_pago">
                        <input type="radio" name="payment-method" value="webpay">
                        <span>WebPay</span>
                    </div>
                </div>
            </div>
            <div class="box-contenido">
                <div class="box-title">
                    <h4>Documento de facturación</h4>
                    <p>Porfavor seleccione una opción</p>
                </div>
                <div class="box-documento-emitir">
                    <div class="titulo_boleta" id="titulo-boleta">
                        <label for="radio_boleta" class="label_radio_documento">
                            <input type="radio" id="radio_boleta" class="radio-tipo-documento" name="tipo_documento" value="boleta">
                            <div class="radio__radio"> </div>
                            boleta
                        </label>
                    </div>
                    <div class="contenido_boleta">
                        <label for="run">Rut:</label>
                        <input type="text" name="rut_boleta" id="rut-boleta" placeholder="ingrese su rut">
                    </div>
                </div>
                <div class="titulo_factura" id="titulo-factura">
                    <label for="radio_factura" class="label_radio_documento">
                        <input type="radio" id="radio_factura" class="radio-tipo-documento" name="tipo_documento" value="factura">
                        <div class="radio__radio"> </div>
                        factura
                    </label>
                </div>
                <div class="contenido_factura">
                    <input type="text" name="razon_social" id="razon-social" placeholder="razon social:">
                    <input type="text" name="rut_factura" id="rut-factura" placeholder="Rut:">
                    <input type="text" name="giro" id="giro" placeholder="Giro:">
                    <input type="text" name="ciudad" id="ciudad" placeholder="Ciudad:">
                    <input type="text" name="comuna" id="comuna" placeholder="Comuna:">
                    <input type="text" name="direccion" id="direccion" placeholder="Direccion:">
                    <input type="text" name="telefono" id="telefono" placeholder="teléfono:">
                </div>
            </div>
            <button class="btn btn-success" id="btn-go-summary-payment">siguiente</button>
        </div>
    </div>
</section>
@endsection

@section('JS')
    <script src="{{url('static/js/payment-method.js')}}"></script>
@endsection