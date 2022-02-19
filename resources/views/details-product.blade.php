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
                            <img src = "{{asset('static/images/default.jpg')}}" alt = "shoe image">
                            <img src = "{{asset('static/images/default.jpg')}}" alt = "shoe image">
                            <img src = "{{asset('static/images/default.jpg')}}" alt = "shoe image">
                            <img src = "{{asset('static/images/default.jpg')}}" alt = "shoe image">
                        </div>
                    </div>
                    <div class = "img-select">
                        <div class = "img-item">
                            <a href = "#" data-id = "1">
                            <img src = "{{asset('static/images/default.jpg')}}" alt = "shoe image">
                            </a>
                        </div>
                        <div class = "img-item">
                            <a href = "#" data-id = "2">
                            <img src = "{{asset('static/images/default.jpg')}}" alt = "shoe image">
                            </a>
                        </div>
                        <div class = "img-item">
                            <a href = "#" data-id = "3">
                            <img src = "{{asset('static/images/default.jpg')}}" alt = "shoe image">
                            </a>
                        </div>
                        <div class = "img-item">
                            <a href = "#" data-id = "4">
                            <img src = "{{asset('static/images/default.jpg')}}" alt = "shoe image">
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="product-content col-lg-6">
                <div class="cotainer-content">
                    <h2 class = "product-title">Titulo Producto</h2>
                    <span class="product-status">Disponible</span>

                    <div class = "product-price">
                        <p class = "last-price">Precio anterior: <span>$257.00</span></p>
                        <p class = "new-price">Nuevo precio: <span>$249.00 (5%)</span></p>
                    </div>

                    <div class = "product-detail">
                        <h2>Acerca del producto: </h2>
                        <ul>
                            <li><i class="bi bi-check-circle-fill"></i>SKU: <span>Black</span></li>
                            <li><i class="bi bi-check-circle-fill"></i>Marca: <span>Black</span></li>
                            <li><i class="bi bi-check-circle-fill"></i>Categoría: <span>in stock</span></li>
                            <li><i class="bi bi-check-circle-fill"></i>Stock: <span>Shoes</span></li>
                        </ul>
                    </div>

                    <div class = "purchase-info">
                        <input type = "number" min = "1" value = "1">
                        <a href="{{url('/cart')}}">
                            <button type = "button" class = "btn"> Añadir al carrito <i class = "fas fa-shopping-cart"></i> </button>
                        </a>              
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
                            <h2 class="tabs__title">Titulo producto...</h2>
                            <p class="tabs__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis ea, laudantium nam tenetur, vitae non quis obcaecati voluptates, pariatur iste tempora sunt maxime id tempore? Unde laboriosam accusantium est ipsum.</p>
                        </div>
                        <div class="tabs__content">
                            <h2 class="tabs__title">Titulo certificado...</h2>
                            <p class="tabs__text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequatur facere animi totam, distinctio, nam veritatis alias odio sunt, doloribus dolor provident temporibus maxime atque? Voluptatem blanditiis similique delectus recusandae quod?</p>
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