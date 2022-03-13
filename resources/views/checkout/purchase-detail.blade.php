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
    
</section>
@endsection
@section('JS')
    <script src="{{url('')}}"></script>
@endsection