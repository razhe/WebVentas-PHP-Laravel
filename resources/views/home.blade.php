@extends('layout')

@section('CSS')
    <link rel="stylesheet" href="{{url('static/css/home.css?v='.time())}}">
    <link rel="stylesheet" href="{{url('static/libs/Glider/glider.css')}}">
@endsection

@section('title', 'Home')

@section ('content')
    <main class="main-home">
        <!--Botón para ir arriba-->
        <div id="container-btn-up" class="container-btn-up">
            <button id="btn-up" class="btn-up">
                <i class="fa-solid fa-angle-up"></i>
            </button>
        </div>
        <section class="seccion-categorias-banner row m-0 g-0">
            <div class="contenido-primario-banner col-lg-6 p-1">
                <div class="banner-categoria-item">
                    <div class="img-categoria-item"><img src="{{asset($categories[0] -> banner)}}" loading="lazy" alt="{{$categories[0] -> name}}" title="Comprar {{$categories[0] -> name}}"></div>
                    <a href="" title="Productos de {{$categories[0] -> name}}">
                        <div class="contenido-categoria-item">
                            <div class="box-contenido-categoria">
                                <h3>{{$categories[0] -> name}}</h3>
                                <p>{{$categories[0] -> description}}</p>
                                <p>{{$categories[0] -> count_products}} productos</p>
                                <p>Comprar</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="contenido-secundario-banner col-lg-6">
                <div class="box-contenido-secundario row m-0">
                    <div class="banner-categoria-item col-lg-6 col-md-6 p-1">
                        <div class="img-categoria-item"><img src="{{asset($categories[1] -> banner)}}" loading="lazy" alt="{{$categories[1] -> name}}" title="Comprar {{$categories[1] -> name}}"></div>
                        <a href="" title="Productos de {{$categories[1] -> name}}">
                            <div class="contenido-categoria-item">
                                <div class="box-contenido-categoria">
                                    <h3>{{$categories[1] -> name}}</h3>
                                    <p>{{$categories[1] -> description}}</p>
                                    <p>{{$categories[1] -> count_products}} productos</p>
                                    <p>Comprar Ahora</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="banner-categoria-item col-lg-6 col-md-6 p-1">
                        <div class="img-categoria-item"><img src="{{asset($categories[2] -> banner)}}" loading="lazy" alt="{{$categories[2] -> name}}" title="Comprar {{$categories[2] -> name}}"></div>
                        <a href="" title="Productos de {{$categories[2] -> name}}">
                            <div class="contenido-categoria-item">
                                <div class="box-contenido-categoria">
                                    <h3>{{$categories[2] -> name}}</h3>
                                    <p>{{$categories[2] -> description}}</p>
                                    <p>{{$categories[2] -> count_products}} productos</p>
                                    <p>Comprar Ahora</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="banner-categoria-item col-lg-6 col-md-6 p-1">
                        <div class="img-categoria-item"><img src="{{asset($categories[3] -> banner)}}" loading="lazy" alt="{{$categories[3] -> name}}" title="Comprar {{$categories[3] -> name}}"></div>
                        <a href="" title="Productos de {{$categories[3] -> name}}">
                            <div class="contenido-categoria-item">
                                <div class="box-contenido-categoria">
                                    <h3>{{$categories[3] -> name}}</h3>
                                    <p>{{$categories[3] -> description}}</p>
                                    <p>{{$categories[3] -> count_products}} productos</p>
                                    <p>Comprar Ahora</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="banner-categoria-item col-lg-6 col-md-6 p-1">
                        <div class="img-categoria-item"><img src="{{asset($categories[4] -> banner)}}" loading="lazy" alt="{{$categories[4] -> name}}" title="Comprar {{$categories[4] -> name}}"></div>
                        <a href="" title="Productos de {{$categories[4] -> name}}">
                            <div class="contenido-categoria-item">
                                <div class="box-contenido-categoria">
                                    <h3>{{$categories[4] -> name}}</h3>
                                    <p>{{$categories[4] -> description}}</p>
                                    <p>{{$categories[4] -> count_products}} productos</p>
                                    <p>Comprar Ahora</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="seccion-mas-vendidos">
            <div class="contenedor-carrousel">
                <div class="col-12 section-intro">
                    <h1>Productos más vendidos</h1>
                    <div class="hline"></div>
                </div>
                <div class="carousel">
                    <div class="carousel_box">
                        <button aria-label="Anterior" class="carousel__anterior anterior-novedades" title="Productos anteriores">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                        <div class="carousel__lista carrousel-novedades">
                            @for ($i = 0; $i < sizeOf($products); $i++)
                                @if (in_array($products[$i] -> id, $diccionario))
                                    @if ($i <= Config::get('configuracion-global.quant_best_sellers_home'))
                                        @if ($products[$i] -> discount != 0)
                                            <div class="item-producto">
                                                <div class="tag-producto">
                                                    <span><i class="fa-brands fa-hotjar"></i></span>
                                                </div>
                                                <div class="producto-imagen">                 
                                                    <img src="{{asset($products[$i] -> image1)}}" loading="lazy" alt="Comprar {{$products[$i] -> name}}" title="{{$products[$i] -> name}}">
                                                    <div class="social-icons">
                                                        <a href="{{url('/details-product?s='.Crypt::encryptString($products[$i] -> slug))}}" title="Características de {{$products[$i] -> name}}"><i class="fa-solid fa-eye"></i></a>
                                                        <a href="{{url('/cart/add?p='.Crypt::encryptString($products[$i] -> id).'&quant=1')}}" title="Comprar {{$products[$i] -> name}}"><i class="fa-solid fa-cart-arrow-down"></i></a>
                                                    </div>
                                                </div>
                                                <div class="p-2">
                                                    <h5 class="title-sm mt-1 mb-0">{{$products[$i] -> name}}</h5>
                                                    <div class="detalle-item-producto">
                                                        <small class="">{{$products[$i] -> brand_name}}</small>
                                                        <div class="product-prices-box">
                                                            <small class="old-price">{{Config::get('configuracion-global.currency') . number_format($products[$i] -> price, 0,  '', '.')}}</small>
                                                            <small class="" title="OFerta!">{{Config::get('configuracion-global.currency').number_format($products[$i] -> price - round((($products[$i] -> discount * $products[$i] -> price) / 100)), 0,  '', '.')}}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="item-producto">
                                                <div class="tag-producto">
                                                    <span><i class="fa-brands fa-hotjar"></i></span>
                                                </div>
                                                <div class="producto-imagen">                 
                                                    <img src="{{asset($products[$i] -> image1)}}" loading="lazy" alt="Comprar {{$products[$i] -> name}}" title="{{$products[$i] -> name}}">
                                                    <div class="social-icons">
                                                        <a href="{{url('/details-product?s='.Crypt::encryptString($products[$i] -> slug))}}" title="Características de {{$products[$i] -> name}}"><i class="fa-solid fa-eye"></i></a>
                                                        <a href="{{url('/cart/add?p='.Crypt::encryptString($products[$i] -> id).'&quant=1')}}" title="Comprar {{$products[$i] -> name}}"><i class="fa-solid fa-cart-arrow-down"></i></a>
                                                    </div>
                                                </div>
                                                <div class="p-2">
                                                    <h5 class="title-sm mt-1 mb-0">{{$products[$i] -> name}}</h5>
                                                    <div class="detalle-item-producto">
                                                        <small class="">{{$products[$i] -> brand_name}}</small>
                                                        <small class="">{{Config::get('configuracion-global.currency') . number_format($products[$i] -> price, 0,  '', '.')}}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        
                                    @endif
                                @endif
                            @endfor
                        </div>
        
                        <button aria-label="Siguiente" class="carousel__siguiente siguente-novedades" title="Siguentes productos">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>
        
                    <div role="tablist" class="carousel__indicadores indicadores-novedades"></div>
                </div>
            </div>
        </section>
        <section id="services">
            <div class="servicios">
                <div class="">
                    <div class="col-12 section-intro">
                        <h1>Nuestros servicios</h1>
                        <div class="hline"></div>
                    </div>
                </div>
                <div class="contenedor-servicios">
                    <div class="row box-servicios m-0">
                        <div class="servicios-item col-lg-4 col-sm-6 p-4">
                            <div class="icon-box">
                                <i class="fa-brands fa-github"></i>
                            </div>
                            <div class="text-box">
                                <h4 class="title-sm mt-4">Lorem, ipsum.</h4>
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem incidunt sunt molestiae!</p>
                            </div>
                            
                        </div>
                        <div class="servicios-item col-lg-4 col-sm-6 p-4">
                            <div class="icon-box">
                                <i class="fa-solid fa-box-archive"></i>
                            </div>
                            <div class="text-box">
                                <h4 class="title-sm mt-4">Lorem, ipsum.</h4>
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem incidunt sunt molestiae!</p>
                            </div>
                        </div>
                        <div class="servicios-item col-lg-4 col-sm-6 p-4">
                            <div class="icon-box">
                                <i class="fa-solid fa-sack-dollar"></i>
                            </div>
                            <div class="text-box">
                                <h4 class="title-sm mt-4">Lorem, ipsum.</h4>
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem incidunt sunt molestiae!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="seccion-ofertas">
            <div class="contenedor-carrousel">
                <div class="col-12 section-intro">
                    <h1>Ofertas</h1>
                    <div class="hline"></div>
                </div>
                <div class="carousel">
                    <div class="carousel_box">
                        <button aria-label="Anterior" class="carousel__anterior anterior-oferta" title="Productos anteriores">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                        <div class="carousel__lista carrousel-ofertas">
                            @for ($i = 0; $i < sizeOf($products); $i++)
                                @if ($products[$i] -> discount != 0)
                                    @if ($i <= Config::get('configuracion-global.quant_oferts_home'))
                                        <div class="item-producto">
                                            <div class="tag-producto">
                                                <span title="Producto en Oferta">-{{$products[$i] -> discount}}%</span>
                                            </div>
                                            <div class="producto-imagen">
                                                <img src="{{asset($products[$i] -> image1)}}" loading="lazy" alt="Comprar {{$products[$i] -> name}}" title="{{$products[$i] -> name}}">
                                                <div class="social-icons">
                                                    <a href="{{url('/details-product?s='.Crypt::encryptString($products[$i] -> slug))}}" title="Características de {{$products[$i] -> name}}"><i class="fa-solid fa-eye"></i></a>
                                                    <a href="{{url('/cart/add?p='.Crypt::encryptString($products[$i] -> id).'&quant=1')}}" title="Comprar {{$products[$i] -> name}}"><i class="fa-solid fa-cart-arrow-down"></i></a>
                                                </div>
                                            </div>
                                            <div class="p-2">
                                                <h5 class="title-sm mt-1 mb-0">{{$products[$i] -> name}}</h5>
                                                <div class="detalle-item-producto">
                                                    <small class="">{{$products[$i] -> brand_name}}</small>
                                                    <div class="product-prices-box">
                                                        <small class="old-price">{{Config::get('configuracion-global.currency') . number_format($products[$i] -> price, 0,  '', '.')}}</small>
                                                        <small class="">{{Config::get('configuracion-global.currency').number_format($products[$i] -> price - round((($products[$i] -> discount * $products[$i] -> price) / 100)), 0,  '', '.')}}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endfor
                        </div>
        
                        <button aria-label="Siguiente" class="carousel__siguiente siguente-oferta" title="Siguientes productos">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>
        
                    <div role="tablist" class="carousel__indicadores indicadores-ofertas"></div>
                </div>
            </div>
        </section>
        
        <section class="marcas-trabajo">
            <div class="contenedor-marcas">
                <div class="contenedor-items-marcas row">
                    @forelse ($brands as $brand)
                        <div class="servicios-item col-lg-4 col-sm-6 p-4">
                            <img src="{{asset($brand -> image)}}" alt="Marca {{$brand -> name}}" title="{{$brand -> name}}">
                        </div>
                    @empty
                        <p>No hay marcas.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </main>
@endsection
@section('JS')
    <script src="{{url('static/libs/Glider/glider.js')}}"></script>
    <script src="{{url('static/js/home.js')}}"></script>
@endsection
    