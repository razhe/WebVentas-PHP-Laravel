@extends('Email.layout')

@section('content')
    <h1>Detalles de la orden</h1>
    @if ($detalles_pago[0]['tipo_doc'] == 'boleta')
        <h2>boleta</h2>
    @else
        <h2>factura</h2>
    @endif
@endsection
