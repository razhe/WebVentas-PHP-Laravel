@extends('checkout.layout')
@section('title', 'Datos del comprador')

@section('CSS')
    <!--CSS-->
        <link rel="stylesheet" href="{{url('static/css/summary-payment.css')}}">
@endsection

@section('content')
<section class="step-wizard">
    <ul class="step-wizard-list">
        <li class="step-wizard-item">
            <span class="progress-count">1</span>
            <span class="progress-label">Datos del comprador</span>
        </li>
        <li class="step-wizard-item">
            <span class="progress-count">2</span>
            <span class="progress-label">Formas de pago</span>
        </li>
        <li class="step-wizard-item current-item">
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
    <div class="summary__container">
        <div class="box__productos">
            <h4>Productos seleccionados</h4>
            <a href="{{url('/cart')}}">Editar carrito</a>
            <table>
                @foreach(Session::get('carrito') as $cart)
                    <tr>
                        <td><img src="{{asset($cart['imagen'])}}" alt="" srcset=""></td>
                        <td>
                            <p>{{$cart['nombre']}}</p>
                            <p>Cantidad: {{$cart['cantidad']}}</p>
                            <p>{{$cart['precio']}}</p>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="box__costos">
            <table>
                <tr>
                    <td>Total Neto</td>
                    <td>{{Config::get('configuracion-global.currency').' '.session('totalCarrito.0.total_neto')}}</td>
                </tr>
                <tr>
                    <td>IVA</td>
                    <td>{{Config::get('configuracion-global.currency').' '.session('totalCarrito.0.iva')}}</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>{{Config::get('configuracion-global.currency').' '.session('totalCarrito.0.total')}}</td>
                </tr>
            </table>
        </div>
        <a href="#"><button class="btn btn-primary">Completar pedido</button></a>
    </div>
</section>
@endsection

@section('JS')
    <!--JS-->
        <script src="{{url('static/js/summary-payment.js')}}"></script>
@endsection