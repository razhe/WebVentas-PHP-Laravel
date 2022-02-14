@extends('layout')
@section('CSS')
    <link rel="stylesheet" href="{{url('static/css/product-catalog.css')}}">
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
                <select name="sort-by" id="">
                    <option value="nombre-asc">Nombre, A a Z</option>
                    <option value="nombre-desc">Nombre, Z a A</option>
                    <option value="precio-asc">Precio, bajo a alto</option>
                    <option value="precio-desc">Precio, alto a bajo</option>
                </select>
            </div>
            <div class="row contenedor-catalogo m-0">
                <div class="seccion__izquierda col-lg-3 col-md-3" id="seccion-izquierda">
                    <div class="contenedor-items-izq">
                        <div class="box-filtros">
                            <div class="titulo-filtro">
                                <h2>Filtrar por</h2>
                                <div class="hline"></div>
                            </div>
                            <div class="lista-filtros">
                                <div class="filtro-especial filtro-box">
                                    <div class="titulo-secciones-filtro"><h3>Especial</h3><i class="bi bi-chevron-down"></i></div>
                                    <div class="contenido-filtro">
                                        <div class="check-item">
                                            <div class="texto-item">
                                                <input type="checkbox" name="ofertas" id="">
                                                <span>Ofertas</span>
                                            </div>
                                            <div class="cantidad-item">
                                                <p>(8)</p>
                                            </div>
                                        </div>
                                        <div class="check-item">
                                            <div class="texto-item">
                                                <input type="checkbox" name="nuevos" id="">
                                                <span>Nuevo</span>
                                            </div>
                                            <div class="cantidad-item">
                                                <p>(8)</p>
                                            </div>
                                        </div>
                                    </div>                                
                                </div>
                                <div class="filtro-precio filtro-box">
                                    <div class="titulo-secciones-filtro"><h3>Precio</h3><i class="bi bi-chevron-down"></i></div>                                  
                                    <div class="precio-item contenido-filtro">
                                        <div class="field">
                                            <span>Min</span>
                                            <input type="number" class="input-min" value="2500">
                                        </div>
                                        <div class="field">
                                            <span>Max</span>
                                            <input type="number" class="input-max" value="7500">
                                        </div>
                                    </div>
                                </div>
                                <div class="filtro-marca filtro-box">
                                    <div class="titulo-secciones-filtro"><h3>Marca</h3><i class="bi bi-chevron-down"></i></div>
                                    <div class="contenido-filtro">
                                        <div class="check-item">
                                            <div class="texto-item">
                                                <input type="checkbox" name="marca" id="">
                                                <span>Nombre marca</span>
                                            </div>
                                            <div class="cantidad-item">
                                                <p>(8)</p>
                                            </div>
                                        </div>
                                        <div class="check-item">
                                            <div class="texto-item">
                                                <input type="checkbox" name="marca" id="">
                                                <span>Nombre marca</span>
                                            </div>
                                            <div class="cantidad-item">
                                                <p>(8)</p>
                                            </div>
                                        </div>
                                        <div class="check-item">
                                            <div class="texto-item">
                                                <input type="checkbox" name="marca" id="">
                                                <span>Nombre marca</span>
                                            </div>
                                            <div class="cantidad-item">
                                                <p>(8)</p>
                                            </div>
                                        </div>
                                        <div class="check-item">
                                            <div class="texto-item">
                                                <input type="checkbox" name="marca" id="">
                                                <span>Nombre marca</span>
                                            </div>
                                            <div class="cantidad-item">
                                                <p>(8)</p>
                                            </div>
                                        </div>
                                        <div class="check-item">
                                            <div class="texto-item">
                                                <input type="checkbox" name="marca" id="">
                                                <span>Nombre marca</span>
                                            </div>
                                            <div class="cantidad-item">
                                                <p>(8)</p>
                                            </div>
                                        </div>
                                    </div>                          
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="seccion__derecha col-lg-9 col-md-9 p-0">
                    <div class="row contenedor-productos g-0">  
                        <div class="box-producto col-lg-3 col-md-4 col-sm-6 p-2">
                            <div class="item-producto">
                                <div class="imagen-producto">
                                    <img src="{{asset('static/images/default.jpg')}}" alt="">
                                    <div class="acciones-producto">
                                        <a href="{{url('/details-product')}}"><i class="bi bi-eye"></i></a>
                                        <a href="#"><i class="bi bi-bag"></i></a>
                                    </div>
                                </div>
                                <div class="info-producto p-1">
                                    <h5 class="titulo-producto">Zapatos</h5>
                                    <div class="detalle-item-producto">
                                        <small class="">Nike</small>
                                        <small class="">$20000</small>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="box-producto col-lg-3 col-md-4 col-sm-6 p-2">
                            <div class="item-producto">
                                <div class="imagen-producto">
                                    <img src="{{asset('static/images/default.jpg')}}" alt="">
                                    <div class="acciones-producto">
                                        <a href="{{url('/details-product')}}"><i class="bi bi-eye"></i></a>
                                        <a href="#"><i class="bi bi-bag"></i></a>
                                    </div>
                                </div>
                                <div class="info-producto p-1">
                                    <h5 class="titulo-producto">Zapatos</h5>
                                    <div class="detalle-item-producto">
                                        <small class="">Nike</small>
                                        <small class="">$20000</small>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="box-producto col-lg-3 col-md-4 col-sm-6 p-2">
                            <div class="item-producto">
                                <div class="imagen-producto">
                                    <img src="{{asset('static/images/default.jpg')}}" alt="">
                                    <div class="acciones-producto">
                                        <a href="{{url('/details-product')}}"><i class="bi bi-eye"></i></a>
                                        <a href="#"><i class="bi bi-bag"></i></a>
                                    </div>
                                </div>
                                <div class="info-producto p-1">
                                    <h5 class="titulo-producto">Zapatos</h5>
                                    <div class="detalle-item-producto">
                                        <small class="">Nike</small>
                                        <small class="">$20000</small>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="box-producto col-lg-3 col-md-4 col-sm-6 p-2">
                            <div class="item-producto">
                                <div class="imagen-producto">
                                    <img src="{{asset('static/images/default.jpg')}}" alt="">
                                    <div class="acciones-producto">
                                        <a href="{{url('/details-product')}}"><i class="bi bi-eye"></i></a>
                                        <a href="#"><i class="bi bi-bag"></i></a>
                                    </div>
                                </div>
                                <div class="info-producto p-1">
                                    <h5 class="titulo-producto">Zapatos</h5>
                                    <div class="detalle-item-producto">
                                        <small class="">Nike</small>
                                        <small class="">$20000</small>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="seccion__inferior">
                    paginacion
                </div>
            </div>
            
        </div>
    </main>
@endsection

@section('JS')
    <script src="{{url('static/js/product-catalog.js')}}"></script>
@endsection