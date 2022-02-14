@extends('layout')

@section('CSS')
    <link rel="stylesheet" href="{{url('static/css/home.css')}}">
    <link rel="stylesheet" href="{{url('static/libs/Glider/glider.css')}}">
    <!--JS-->
        <!--JQuery-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('title', 'Home')

@section ('content')
    <main class="main-home">
        <section class="seccion-categorias-banner row">
            <div class="contenido-primario-banner col-lg-6 p-1">
                <div class="banner-categoria-item">
                    <div class="img-categoria-item"><img src="{{asset('img/banner/herramientas-default.jpg')}}" alt=""></div>
                    <div class="contenido-categoria-item">
                        <div class="box-contenido-categoria">
                            <h3>Titulo</h3>
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam est provident aliquid expedita?</p>
                            <p>234 productos</p>
                            <a href="">Comprar Ahora</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contenido-secundario-banner col-lg-6">
                <div class="row">
                    <div class="banner-categoria-item col-lg-6 col-md-6 p-1">
                        <div class="img-categoria-item"><img src="{{asset('img/banner/herramientas-default.jpg')}}" alt=""></div>
                        <div class="contenido-categoria-item">
                            <div class="box-contenido-categoria">
                                <h3>Titulo</h3>
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam est provident aliquid expedita?</p>
                                <p>234 productos</p>
                                <a href="">Comprar Ahora</a>
                            </div>
                        </div>
                    </div>
                    <div class="banner-categoria-item col-lg-6 col-md-6 p-1">
                        <div class="img-categoria-item"><img src="{{asset('img/banner/herramientas-default.jpg')}}" alt=""></div>
                        <div class="contenido-categoria-item">
                            <div class="box-contenido-categoria">
                                <h3>Titulo</h3>
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam est provident aliquid expedita?</p>
                                <p>234 productos</p>
                                <a href="">Comprar Ahora</a>
                            </div>
                        </div>
                    </div>
                    <div class="banner-categoria-item col-lg-6 col-md-6 p-1">
                        <div class="img-categoria-item"><img src="{{asset('img/banner/herramientas-default.jpg')}}" alt=""></div>
                        <div class="contenido-categoria-item">
                            <div class="box-contenido-categoria">
                                <h3>Titulo</h3>
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam est provident aliquid expedita?</p>
                                <p>234 productos</p>
                                <a href="">Comprar Ahora</a>
                            </div>
                        </div>
                    </div>
                    <div class="banner-categoria-item col-lg-6 col-md-6 p-1">
                        <div class="img-categoria-item"><img src="{{asset('img/banner/herramientas-default.jpg')}}" alt=""></div>
                        <div class="contenido-categoria-item">
                            <div class="box-contenido-categoria">
                                <h3>Titulo</h3>
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam est provident aliquid expedita?</p>
                                <p>234 productos</p>
                                <a href="">Comprar Ahora</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="seccion-novedades">
            <div class="contenedor-carrousel">
                <div class="col-12 section-intro">
                    <h1>Novedades</h1>
                    <div class="hline"></div>
                </div>
                <div class="carousel">
                    <div class="carousel_box">
                        <button aria-label="Anterior" class="carousel__anterior anterior-novedades">
                            <i class="bi bi-arrow-left-circle-fill"></i>
                        </button>
                        <div class="carousel__lista carrousel-novedades">
                            <div class="item-producto">
                                <div class="producto-imagen">
                                    <img src="{{asset('static/images/default.jpg')}}" alt="">
                                    <div class="social-icons">
                                        <a href="{{url('/details-product')}}"><i class="bi bi-eye"></i></a>
                                        <a href="#"><i class="bi bi-bag"></i></a>
                                    </div>
                                </div>
                                <div class="p-2">
                                    <h5 class="title-sm mt-1 mb-0">Zapatos</h5>
                                    <div class="detalle-item-producto">
                                        <small class="">Nike</small>
                                        <small class="">$20000</small>
                                    </div>
                                </div>
                            </div>
                            <div class="item-producto">
                                <div class="producto-imagen">
                                    <img src="{{asset('static/images/default.jpg')}}" alt="">
                                    <div class="social-icons">
                                        <a href="{{url('/details-product')}}"><i class="bi bi-eye"></i></a>
                                        <a href="#"><i class="bi bi-bag"></i></a>
                                    </div>
                                </div>
                                <div class="p-2">
                                    <h5 class="title-sm mt-1 mb-0">Zapatos</h5>
                                    <div class="detalle-item-producto">
                                        <small class="">Nike</small>
                                        <small class="">$20000</small>
                                    </div>
                                </div>
                            </div>
                            <div class="item-producto">
                                <div class="producto-imagen">
                                    <img src="{{asset('static/images/default.jpg')}}" alt="">
                                    <div class="social-icons">
                                        <a href="{{url('/details-product')}}"><i class="bi bi-eye"></i></a>
                                        <a href="#"><i class="bi bi-bag"></i></a>
                                    </div>
                                </div>
                                <div class="p-2">
                                    <h5 class="title-sm mt-1 mb-0">Zapatos</h5>
                                    <div class="detalle-item-producto">
                                        <small class="">Nike</small>
                                        <small class="">$20000</small>
                                    </div>
                                </div>
                            </div>
                            <div class="item-producto">
                                <div class="producto-imagen">
                                    <img src="{{asset('static/images/default.jpg')}}" alt="">
                                    <div class="social-icons">
                                        <a href="{{url('/details-product')}}"><i class="bi bi-eye"></i></a>
                                        <a href="#"><i class="bi bi-bag"></i></a>
                                    </div>
                                </div>
                                <div class="p-2">
                                    <h5 class="title-sm mt-1 mb-0">Zapatos</h5>
                                    <div class="detalle-item-producto">
                                        <small class="">Nike</small>
                                        <small class="">$20000</small>
                                    </div>
                                </div>
                            </div>
            
                            <div class="item-producto">
                                <div class="producto-imagen">
                                    <img src="{{asset('static/images/default.jpg')}}" alt="">
                                    <div class="social-icons">
                                        <a href="{{url('/details-product')}}"><i class="bi bi-eye"></i></a>
                                        <a href="#"><i class="bi bi-bag"></i></a>
                                    </div>
                                </div>
                                <div class="p-2">
                                    <h5 class="title-sm mt-1 mb-0">Zapatos</h5>
                                    <div class="detalle-item-producto">
                                        <small class="">Nike</small>
                                        <small class="">$20000</small>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <button aria-label="Siguiente" class="carousel__siguiente siguente-novedades">
                            <i class="bi bi-arrow-right-circle-fill"></i>
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
                    <div class="row box-servicios">
                        <div class="servicios-item col-lg-4 col-sm-6 p-4">
                            <div class="icon-box">
                                <i class="bi bi-alarm"></i>
                            </div>
                            <div class="text-box">
                                <h4 class="title-sm mt-4">Lorem, ipsum.</h4>
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem incidunt sunt molestiae!</p>
                            </div>
                            
                        </div>
                        <div class="servicios-item col-lg-4 col-sm-6 p-4">
                            <div class="icon-box">
                                <i class="bi bi-archive"></i>
                            </div>
                            <div class="text-box">
                                <h4 class="title-sm mt-4">Lorem, ipsum.</h4>
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem incidunt sunt molestiae!</p>
                            </div>
                        </div>
                        <div class="servicios-item col-lg-4 col-sm-6 p-4">
                            <div class="icon-box">
                                <i class="bi bi-cash-coin"></i>
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

        <section class="seccion-mas-vendidos">
            <div class="contenedor-carrousel">
                <div class="col-12 section-intro">
                    <h1>Más vendidos</h1>
                    <div class="hline"></div>
                </div>
                <div class="carousel">
                    <div class="carousel_box">
                        <button aria-label="Anterior" class="carousel__anterior anterior-mas-vendido">
                            <i class="bi bi-arrow-left-circle-fill"></i>
                        </button>
                        <div class="carousel__lista carrousel-mas-vendidos">
                            <div class="item-producto">
                                <div class="producto-imagen">
                                    <img src="{{asset('static/images/default.jpg')}}" alt="">
                                    <div class="social-icons">
                                        <a href="{{url('/details-product')}}"><i class="bi bi-eye"></i></a>
                                        <a href="#"><i class="bi bi-bag"></i></a>
                                    </div>
                                </div>
                                <div class="p-2">
                                    <h5 class="title-sm mt-1 mb-0">Zapatos</h5>
                                    <div class="detalle-item-producto">
                                        <small class="">Nike</small>
                                        <small class="">$20000</small>
                                    </div>
                                </div>
                            </div>
                            <div class="item-producto">
                                <div class="producto-imagen">
                                    <img src="{{asset('static/images/default.jpg')}}" alt="">
                                    <div class="social-icons">
                                        <a href="{{url('/details-product')}}"><i class="bi bi-eye"></i></a>
                                        <a href="#"><i class="bi bi-bag"></i></a>
                                    </div>
                                </div>
                                <div class="p-2">
                                    <h5 class="title-sm mt-1 mb-0">Zapatos</h5>
                                    <div class="detalle-item-producto">
                                        <small class="">Nike</small>
                                        <small class="">$20000</small>
                                    </div>
                                </div>
                            </div>
                            <div class="item-producto">
                                <div class="producto-imagen">
                                    <img src="{{asset('static/images/default.jpg')}}" alt="">
                                    <div class="social-icons">
                                        <a href="{{url('/details-product')}}"><i class="bi bi-eye"></i></a>
                                        <a href="#"><i class="bi bi-bag"></i></a>
                                    </div>
                                </div>
                                <div class="p-2">
                                    <h5 class="title-sm mt-1 mb-0">Zapatos</h5>
                                    <div class="detalle-item-producto">
                                        <small class="">Nike</small>
                                        <small class="">$20000</small>
                                    </div>
                                </div>
                            </div>
                            <div class="item-producto">
                                <div class="producto-imagen">
                                    <img src="{{asset('static/images/default.jpg')}}" alt="">
                                    <div class="social-icons">
                                        <a href="{{url('/details-product')}}"><i class="bi bi-eye"></i></a>
                                        <a href="#"><i class="bi bi-bag"></i></a>
                                    </div>
                                </div>
                                <div class="p-2">
                                    <h5 class="title-sm mt-1 mb-0">Zapatos</h5>
                                    <div class="detalle-item-producto">
                                        <small class="">Nike</small>
                                        <small class="">$20000</small>
                                    </div>
                                </div>
                            </div>
            
                            <div class="item-producto">
                                <div class="producto-imagen">
                                    <img src="{{asset('static/images/default.jpg')}}" alt="">
                                    <div class="social-icons">
                                        <a href="{{url('/details-product')}}"><i class="bi bi-eye"></i></a>
                                        <a href="#"><i class="bi bi-bag"></i></a>
                                    </div>
                                </div>
                                <div class="p-2">
                                    <h5 class="title-sm mt-1 mb-0">Zapatos</h5>
                                    <div class="detalle-item-producto">
                                        <small class="">Nike</small>
                                        <small class="">$20000</small>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <button aria-label="Siguiente" class="carousel__siguiente siguente-mas-vendido">
                            <i class="bi bi-arrow-right-circle-fill"></i>
                        </button>
                    </div>
        
                    <div role="tablist" class="carousel__indicadores indicadores-mas-vendido"></div>
                </div>
            </div>
        </section>
        
        <section class="marcas-trabajo">
            <div class="contenedor-marcas">
                <div class="contenedor-items-marcas row">
                    <div class="servicios-item col-lg-4 col-sm-6 p-4">
                       <img src="{{asset('static/images/marca-default.png')}}" alt="">
                    </div>
                    <div class="servicios-item col-lg-4 col-sm-6 p-4">
                        <img src="{{asset('static/images/marca-default.png')}}" alt="">
                    </div>
                    <div class="servicios-item col-lg-4 col-sm-6 p-4">
                        <img src="{{asset('static/images/marca-default.png')}}" alt="">
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('JS')
    <script src="{{url('static/libs/Glider/glider.js')}}"></script>
    <script src="{{url('static/js/home.js')}}"></script>
@endsection
    