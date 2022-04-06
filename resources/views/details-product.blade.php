@extends('layout')
@section('CSS')
    <link rel="stylesheet" href="{{url('static/css/details-product.css')}}">
    <link rel="stylesheet" href="{{url('static/libs/Glider/glider.css')}}">
@endsection

@section('title', 'Detalles del producto')

@section('content')
    <main class="details-product">
        <div class="container-product-detail row">
            <section class="breadcrumbs">
                <div class="box-breadcrumbs">
                    <ul class="breadcrumbs">
                        <li class="breadcrumbs__item"><a href="{{url('/')}}" class="bradcrumbs--link">Home</a></li>
                        <li class="breadcrumbs__item"><span class="bradcrumbs--link--active">Detalles del producto</span></li>
                    </ul>
                </div>
            </section>
            <section class="imgs-section col-lg-6">
                <div class = "product-imgs">
                    <div class = "img-display">
                        <div class = "img-showcase">
                            <img src = "{{asset($product[0] -> image1)}}" alt = "shoe image">
                            <img src = "{{asset($product[0] -> image2)}}" alt = "shoe image">
                            <img src = "{{asset($product[0] -> image3)}}" alt = "shoe image">
                            <img src = "{{asset($product[0] -> image4)}}" alt = "shoe image">
                        </div>
                    </div>
                    <div class = "img-select">
                        <div class = "img-item">
                            <a href = "#" data-id = "1">
                            <img src = "{{asset($product[0] -> image1)}}" alt = "shoe image">
                            </a>
                        </div>
                        <div class = "img-item">
                            <a href = "#" data-id = "2">
                            <img src = "{{asset($product[0] -> image2)}}" alt = "shoe image">
                            </a>
                        </div>
                        <div class = "img-item">
                            <a href = "#" data-id = "3">
                            <img src = "{{asset($product[0] -> image3)}}" alt = "shoe image">
                            </a>
                        </div>
                        <div class = "img-item">
                            <a href = "#" data-id = "4">
                            <img src = "{{asset($product[0] -> image4)}}" alt = "shoe image">
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="product-content col-lg-6">
                <div class="cotainer-content">
                    <h2 class = "product-title">{{$product[0] -> name}}</h2>
                    @if ($product[0] -> stock == 0)
                        <span class="product-status status-outofstock">Agotado</span>
                    @else
                        <span class="product-status status-instock">Disponible</span>
                    @endif
                    <div class = "product-price">
                        @if ($product[0] -> discount != 0)
                            <p class = "last-price">Precio anterior: <span>{{Config::get('configuracion-global.currency').$product[0] -> price}}</span></p>
                            <p class = "new-price">Nuevo precio: <span>{{Config::get('configuracion-global.currency').$product[0]->price - round((($product[0] -> discount * $product[0] -> price) / 100))}}</span></p>
                        @else
                            <p class = "new-price">Precio: <span>{{Config::get('configuracion-global.currency').$product[0]->price}}</span></p>
                        @endif
                    </div>

                    <div class = "product-detail">
                        <h2>Acerca del producto: </h2>
                        <ul>
                            <li><i class="bi bi-check-circle-fill"></i>SKU: <span>{{$product[0]->sku}}</span></li>
                            <li><i class="bi bi-check-circle-fill"></i>Marca: <span>{{$product[0]->brand_name}}</span></li>
                            <li><i class="bi bi-check-circle-fill"></i>Subcategoría: <span>{{$product[0]->subcategory_name}}</span></li>
                            <li><i class="bi bi-check-circle-fill"></i>Stock: <span>{{$product[0]->stock}}</span></li>
                            <li><i class="bi bi-check-circle-fill"></i>IVA: <span>No incluye ({{Config::get('configuracion-global.iva')}}%)</span></li>
                        </ul>
                    </div>

                    <div class = "purchase-info">
                        <form class="form__add_toCart" action="{{url('/cart/add')}}" method="get">
                            <input type="hidden" name="p" value="{{Crypt::encryptString($product[0] -> id)}}">
                            <input name="quant" type = "number" min = "1" max="{{$product[0]->stock}}" value = "1">
                            <button type = "submit" class = "btn"> Añadir al carrito <i class = "fas fa-shopping-cart"></i> </button>
                        </form>              
                    </div>
                    
                </div>
            </section>

            <section class="product-tabs">
                <div class="tabs__container">
                    <div class="tabs__head">
                        <span class="tabs__toggle active">Descripción</span>
                        <span class="tabs__toggle">Certificado</span>
                    </div>
                    <div class="tabs__body">
                        <div class="tabs__content active">
                            <h2 class="tabs__title">{{$product[0] -> name}}</h2>
                            <p class="tabs__text">{!! $product[0] -> description !!}</p>
                        </div>
                        <div class="tabs__content">
                            @if ($product[0] -> certificate == null)
                                <h2 class="tabs__title">El producto {{$product[0] -> name}}, no posee con un certificado.</h2>
                            @else
                                <center>
                                    <iframe src="{{url($product[0] -> certificate)}}"></iframe>
                                </center>
                            @endif
                            
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    
@endsection

@section('JS')
    <script src="{{url('static/js/details-product.js')}}"></script>
    <script src="{{url('static/libs/Glider/glider.js')}}"></script>
@endsection