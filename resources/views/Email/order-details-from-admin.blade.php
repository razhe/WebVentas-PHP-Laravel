@extends('Email.layout')

@section('content')
    <h1>Detalles de la orden</h1>
    @if (!empty($ventas[0] -> id_boleta))
        <h2>boleta</h2>
    @else
        <h2>factura</h2>
    @endif
@endsection
