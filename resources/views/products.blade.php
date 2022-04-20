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
            @if (!empty($subcategory_slug))
            <form action="{{url('/products/filter?subcategory='.$subcategory_slug)}}" method="post">
                @csrf
            @else
            <form action="{{url('/products/filter')}}" method="post">
                @csrf
            @endif
            
            <div class="row contenedor-catalogo m-0">
                <div class="seccion__superior">
                    <button type="button" class="btn-mostrar-filtros" id="mostrar-filtros"><i class="fa-solid fa-bars"></i></button>
                    <span>Se han encontrado {{count($products)}} productos.</span>
                    
                        <select name="sort-by" id="sort-by" onchange="this.form.submit();">
                            <option disabled selected value="">Orden por defecto</option>
                            <option value="name-asc" @if(!empty($_GET['sort-by']) && $_GET['sort-by'] == 'name-asc') selected @endif>Nombre, A a Z</option>
                            <option value="name-desc" @if(!empty($_GET['sort-by']) && $_GET['sort-by'] == 'name-desc') selected @endif>Nombre, Z a A</option>
                            <option value="price-asc" @if(!empty($_GET['sort-by']) && $_GET['sort-by'] == 'price-asc') selected @endif>Precio, bajo a alto</option>
                            <option value="price-desc" @if(!empty($_GET['sort-by']) && $_GET['sort-by'] == 'price-desc') selected @endif>Precio, alto a bajo</option>
                        </select>
                </div>
                <div class="seccion__izquierda col-lg-3 col-md-3" id="seccion-izquierda">
                    <div class="contenedor-items-izq" id="contenedor-items-izq">
                        <div class="box-filtros">
                            <div class="titulo-filtro">
                                <h2>Filtrar por</h2>
                                <div class="hline"></div>
                            </div>
                            <div class="lista-filtros">
                                <div class="filtro-especial filtro-box">
                                    <div class="titulo-secciones-filtro"><h3>Especial</h3><i class="fa-solid fa-chevron-down"></i></div>
                                    <div class="contenido-filtro">
                                        @if (!empty($_GET['special']))
                                            @php
                                                $filter_special=explode(',',$_GET['special']);
                                            @endphp
                                        @endif
                                        <div class="check-item">
                                            <div class="texto-item">
                                                <input type="checkbox" name="special[]" id="" value="ofertas" @if(!empty($filter_special) && in_array('ofertas', $filter_special)) checked @endif onchange="this.form.submit();">
                                                <span>Ofertas</span>
                                            </div>
                                            
                                        </div>
                                        <div class="check-item">
                                            <div class="texto-item">
                                                <input type="checkbox" name="special[]" value="mas-vendido" id="" @if(!empty($filter_special) && in_array('mas-vendido', $filter_special)) checked @endif  onchange="this.form.submit();">
                                                <span>Mas vendido</span>
                                            </div>
                                            
                                        </div>
                                    </div>                                
                                </div>
                                <div class="filtro-precio filtro-box">
                                    <div class="titulo-secciones-filtro"><h3>Precio</h3><i class="fa-solid fa-chevron-down"></i></div>                                  
                                    <div class="precio-item contenido-filtro">
                                        <div class="field">
                                            <label for="min-price">Mínimo</label>
                                            <input type="number" name="min-price" class="input-min" @if(!empty($_GET['min-price'])) value="{{$_GET['min-price']}}" @endif>
                                        </div>
                                        <div class="field">
                                            <label for="max-price">Máximo</label>
                                            <input type="number" name="max-price" class="max-price" @if(!empty($_GET['max-price'])) value="{{$_GET['max-price']}}" @endif>
                                        </div>
                                        <div class="filter-btn">
                                            <button type="submit"><i class="fa-solid fa-filter"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="filtro-marca filtro-box">
                                    <div class="titulo-secciones-filtro"><h3>Marca</h3><i class="fa-solid fa-chevron-down"></i></div>
                                    <div class="contenido-filtro">
                                        @if (!empty($_GET['brand']))
                                            @php
                                                $filter_brands=explode(',',$_GET['brand']);
                                            @endphp
                                        @endif
                                        @foreach ($brands as $brand)
                                            <div class="check-item">
                                                <div class="texto-item">
                                                    <input type="checkbox" @if(!empty($filter_brands) && in_array($brand->name, $filter_brands)) checked @endif name="brand[]" onchange="this.form.submit();" value="{{$brand -> name}}">
                                                    <span>{{$brand -> name}}</span>
                                                </div>
                                                <div class="cantidad-item">
                                                    <p>({{$brand -> count_prods}})</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>                          
                                </div>
                            </div>
            </form>
                        </div>
                    </div>
                </div>
                <div class="seccion__derecha col-lg-9 col-md-9 p-0">
                    <div class="row contenedor-productos g-0">  
                        @foreach ($products as $product)
                            <div class="box-producto col-lg-4 col-md-6 col-sm-6 p-2">
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
                                                    <small class="">{{Config::get('configuracion-global.currency').number_format($product -> price - round((($product -> discount * $product -> price) / 100)), 0,  '', '.')}}</small>
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