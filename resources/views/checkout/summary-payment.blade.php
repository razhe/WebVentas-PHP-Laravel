@extends('checkout.layout')
@section('title', 'Datos del comprador')

@section('CSS')
    <!--CSS-->
        <link rel="stylesheet" href="{{url('static/css/summary-payment.css?v='.time())}}">
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
    </ul>
</section>
<section class="checkout-content">
    <div class="row m-0 g-0 summary__container">
        <div class="box-title">
            <h4>Productos seleccionados</h4>
            <div class="hline"></div>
        </div>
        <a href="{{url('/cart')}}">Editar carrito</a>
        <div class="box__productos col-lg-7">
            <!--carrito-->
            <section class="cart-section">
                <div class="cart-container-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                            </tr> 
                        </thead>
                        <tbody id="box-rows-carrito">
                            @foreach(Session::get('carrito') as $cart)
                                <tr>
                                    <td>
                                        <div class="cart-info">
                                            <img src="{{asset($cart['imagen'])}}" alt="">
                                            <div>
                                                <p>{{$cart['nombre']}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{$cart['cantidad']}}</td>
                                    
                                    <td><p>{{Config::get('configuracion-global.currency').number_format($cart['subtotal'], 0,  '', '.')}}</p></td>
                                </tr>
                            @endforeach
                        </tbody>    
                    </table>
                    <div class="" id="container-no-cart-content">
                        
                    </div>
                </div>
            </section>
        </div>
        <div class="box__costos col-lg-4">
            <div class="lista_costos">
                <div class="total-neto item-costos">
                    <h4>Total Neto</h4>
                    <p>{{Config::get('configuracion-global.currency').' '.number_format(session('totalCarrito.0.total_neto'), 0,  '', '.')}}</p>
                </div>
                <div class="iva item-costos">
                    <h4>IVA</h4>
                    <p>{{Config::get('configuracion-global.currency').' '.number_format(session('totalCarrito.0.iva'), 0,  '', '.')}}</p>
                </div>
                <div class="total item-costos">
                    <h4>Total</h4>
                    <p>{{Config::get('configuracion-global.currency').' '.number_format(session('totalCarrito.0.total'), 0,  '', '.')}}</p>
                </div>
            </div>
            @if (Session::has('payment-billing'))
                @if (session('payment-billing.0.medio_pago') == 'WebPay')
                    <form action="{{url('/transbank/iniciar-compra')}}" method="post">
                        @csrf
                        <button type="submit" class="btn-default-yellow">Completar pedido</button>
                    </form>   
                @endif
                @if (session('payment-billing.0.medio_pago') == 'Transferencia-bancaria')
                    <form action="{{url('/checkout/bank-transfer')}}" method="post">
                        @csrf
                        <button type="submit" class="btn-default-yellow">Completar pedido</button>
                    </form>   
                @endif
                             
            @endif
            
        </div>
        
        
    </div>
</section>
@endsection

@section('JS')
    <!--JS-->
        <script src="{{url('static/js/summary-payment.js')}}"></script>
@endsection