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
                <button class="btn-mostrar-filtros" id="mostrar-filtros"><i class="fa-solid fa-bars"></i></button>
                <span>Se han encontrado {{count($products)}} productos.</span>
            </div>
            <div class="row contenedor-catalogo m-0">
                <div class="seccion__derecha col-lg-12 col-md-12 p-0">
                    <div class="row contenedor-productos g-0">  
                        @foreach ($products as $product)
                            <div class="box-producto col-lg-3 col-md-6 col-sm-6 p-2">
                                @if ($product -> discount != 0)
                                    <div class="item-producto">
                                        <div class="tag-producto">
                                            <span>-{{$product -> discount}}%</span>
                                        </div>
                                        <div class="producto-imagen">  
                                            <img src="{{asset($product -> image1)}}" alt="">
                                            <div class="social-icons">
                                                <a href="{{url('/details-product?s='.Crypt::encryptString($product -> slug))}}"><i class="fa-solid fa-eye"></i></a>
                                                <a href="{{url('/cart/add?p='.Crypt::encryptString($product -> id).'&quant=1')}}"><i class="fa-solid fa-cart-arrow-down"></i></a>
                                            </div>
                                        </div>
                                        <div class="p-2">
                                            <h5 class="title-sm mt-1 mb-0">{{$product -> name}}</h5>
                                            <div class="detalle-item-producto">
                                                <small class="">{{$product -> brand_name}}</small>
                                                <div class="product-prices-box">
                                                    <small class="old-price">{{Config::get('configuracion-global.currency').number_format($product -> price, 0,  '', '.')}}</small>
                                                    <small class="">{{Config::get('configuracion-global.currency'). number_format($product -> price - round((($product -> discount * $product -> price) / 100)), 0,  '', '.')}}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                <div class="item-producto">
                                    <div class="producto-imagen">  
                                        <img src="{{asset($product -> image1)}}" alt="">
                                        <div class="social-icons">
                                            <a href="{{url('/details-product?s='.Crypt::encryptString($product -> slug))}}"><i class="fa-solid fa-eye"></i></a>
                                            <a href="{{url('/cart/add?p='.Crypt::encryptString($product -> id).'&quant=1')}}"><i class="fa-solid fa-cart-arrow-down"></i></a>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <h5 class="title-sm mt-1 mb-0">{{$product -> name}}</h5>
                                        <div class="detalle-item-producto">
                                            <small class="">{{$product -> brand_name}}</small>
                                            <div class="product-prices-box">
                                                <small class="">{{Config::get('configuracion-global.currency').number_format($product -> price, 0,  '', '.')}}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
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