@extends('checkout.layout')
@section('title', 'Datos del comprador')

@section('CSS')
    <!--CSS-->
        <link rel="stylesheet" href="{{url('')}}">
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
        <li class="step-wizard-item">
            <span class="progress-count">3</span>
            <span class="progress-label">Resumen y Pago</span>
        </li>
        <li class="step-wizard-item">
            <span class="progress-count current-item">4</span>
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
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre del artículo</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>% Descuento</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < sizeOf($productos); $i++)
                <tr>
                    <td>-</td>
                    <td>{{$productos[$i]['nombre']}}</td>
                    <td>{{$productos[$i]['precio']}}</td>
                    <td>{{$productos[$i]['cantidad']}}</td>
                    <td>{{$productos[$i]['descuento']}} %</td>
                    <td>{{$productos[$i]['subtotal']}}</td>
                </tr>
            @endfor
        </tbody>
    </table>

    <table>
        <tbody id="box-rows-totalCarrito">
            <tr>
                <td>Total Neto</td>
                <td>{{$totales[0]['total_neto']}}</td>
            </tr>
            <tr>
                <td>IVA{{Config::get('configuracion-global.iva')}}</td>
                <td>{{$totales[0]['iva']}}</td>
            </tr>
            <tr>
                <td>Total</td>
                <td>{{$totales[0]['total']}}</td>
            </tr>
        </tbody>
    </table>

    <a href="{{url('/profile')}}">Ver mis compras</a>
    <a href="{{url('/products')}}">Seguir comprando</a>
</section>
@endsection
@section('JS')
    <script src="{{url('')}}"></script>
@endsection