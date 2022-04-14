@extends('checkout.layout')
@section('title', 'Datos del comprador')

@section('CSS')
    <!--CSS-->
        <link rel="stylesheet" href="{{url('static/css/purchase-detail.css')}}">
@endsection

@section('content')
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
    <div class="box-title">
        <h4>Detalles de la compra</h4>
        <div class="hline"></div>
    </div>
    <div class="box-tabla-compras">
        <table class="table-detail">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre del artículo</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Descuento</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < sizeOf($productos); $i++)
                    <tr>
                        <td>-</td>
                        <td>{{$productos[$i]['nombre']}}</td>
                        <td>{{Config::get('configuracion-global.currency').$productos[$i]['precio']}}</td>
                        <td>{{$productos[$i]['cantidad']}}</td>
                        <td>{{$productos[$i]['descuento']}} %</td>
                        <td>{{Config::get('configuracion-global.currency').$productos[$i]['subtotal']}}</td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
    <div class="box-tabla-summary">
        <table class="table-summary">
            <tbody id="box-rows-totalCarrito">
                <tr>
                    <td><strong>Total Neto</strong></td>
                    <td>{{Config::get('configuracion-global.currency').$totales[0]['total_neto']}}</td>
                </tr>
                <tr>
                    <td><strong>IVA ({{Config::get('configuracion-global.iva')}}%)</strong></td>
                    <td>{{Config::get('configuracion-global.currency').$totales[0]['iva']}}</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td>{{Config::get('configuracion-global.currency').$totales[0]['total']}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="opts-purchase-detail">
        <a class="" href="{{url('/profile')}}">Ver mis compras</a>
        <a class="" href="{{url('/products')}}">Seguir comprando <i class="fa-solid fa-arrow-right-long"></i></a>
    </div>
</section>
@endsection
@section('JS')
    <script src="{{url('static/js/purchase-detail.js')}}"></script>
@endsection