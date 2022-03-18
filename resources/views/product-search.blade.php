@extends('layout')
@section('CSS')
    <link rel="stylesheet" href="{{url('static/css/products.css')}}">
@endsection
@section('title', 'Catálogo')

@section('content')
    <main class="main-product-catalog">
        <div class="container-catalog">
            <section class="breadcrumbs">
                <div class="box-breadcrumbs">
                    <ul class="breadcrumbs">
                        <li class="breadcrumbs__item"><a href="{{url('/')}}" class="bradcrumbs--link">Home</a></li>
                        <li class="breadcrumbs__item"><span class="bradcrumbs--link--active">Catálogo productos</span></li>
                    </ul>
                </div>
            </section>
            
            <div class="seccion__superior">
                <button class="btn-mostrar-filtros" id="mostrar-filtros"><i class="bi bi-layout-sidebar-inset"></i></button>
                <span>Mostrando 9 productos</span>
            </div>
            <div class="row contenedor-catalogo m-0">
                <div class="seccion__derecha col-lg-12 col-md-12 p-0">
                    <div class="row contenedor-productos g-0">  
                        @foreach ($products as $product)
                            <div class="box-producto col-lg-3 col-md-4 col-sm-6 p-2">
                                <div class="item-producto">
                                    <div class="imagen-producto">
                                        <img src="{{asset($product -> image1)}}" alt="">
                                        <div class="acciones-producto">
                                            <a href="{{url('/details-product?s='.Crypt::encryptString($product -> slug))}}"><i class="bi bi-eye"></i></a>
                                            <a href="{{url('/cart/add?p='.Crypt::encryptString($product -> id).'&quant=1')}}"><i class="bi bi-bag"></i></a>
                                        </div>
                                    </div>
                                    <div class="info-producto p-1">
                                        <h5 class="titulo-producto">{{$product -> name}}</h5>
                                        <div class="detalle-item-producto">
                                            <small class="">{{$product -> brand_name}}</small>
                                            <small class="">{{Config::get('configuracion-global.currency').$product -> price}}</small>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        @endforeach 
                    </div>
                </div>
                <div class="seccion__inferior">
                    {{ $products -> links() }}
                </div>
            </div>
            
        </div>
    </main>
@endsection

@section('JS')
    <script src="{{url('static/js/products.js')}}"></script>
@endsection