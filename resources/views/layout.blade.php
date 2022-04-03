<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="currency" content="{{Config::get('configuracion-global.currency')}}">
    <meta name="routeName" content="{{Route::currentRouteName()}}">
    <title>{{Config::get('configuracion-global.name')}} | @yield('title')</title>
    @yield('CSS')
    <!--CSS-->
        <!--CSS Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
        <!--Componente para urls absolutas-->
        <link rel="stylesheet" href="{{ url('/static/css/layout.css') }}">
        <!--CSS Bootstrap Icons-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css" integrity="sha512-1fPmaHba3v4A7PaUsComSM4TBsrrRGs+/fv0vrzafQ+Rw+siILTiJa0NtFfvGeyY5E182SDTaF5PqP+XOHgJag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!--CSS Toastr-->
        <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <!--JS-->
        <!--JQuery-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body>
    <header>
        <nav class="menu" id="menu">
            <div class="contenedor seccion-superior-nav" id="seccion-superior-nav">
                <div class="contenedor-logo-nav">
                    <img src="{{url('/static/images/logo.png')}}" alt="">
                </div>
                <div class="contenedor-busq-nav ">
                    <form class="form-buscar" action="{{url('/product/search/')}}" method="post">
                        @csrf
                        <div class="busqueda-box input-group">
                            <input type="text" name="search" class="form-control" placeholder="Busca aquí...">
                            <button class="btn-buscar-nav btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                        </div> 
                    </form>              
                </div>
                <div class="contenedor-opt-usr">
                    <div class="contenedor-carrito">
                        <div class=""><a href="{{url('/cart')}}"><i class="bi bi-cart3"></i></a></div>
                        @if (Session::has('totalCarrito'))
                            <div class=""><div class="contador-carrito">{{session('totalCarrito.0.cantidadProductos')}}</div></div>
                        @else
                            <div class=""><div class="contador-carrito">0</div></div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="contenedor contenedor-btn-nav">
                <button id="btn-menu-barras" class="btn-menu-barras">
                    <i class="bi bi-list"></i>
                </button>
                <button id="btn-menu-cerrar" class="btn-menu-cerrar">
                    <i class="bi bi-x"></i>
                </button>
            </div>
            <div class="seccion-inferior-nav">
                <div id="contenedor-enlaces-nav" class="contenedor contenedor-enlaces-nav">
                    <div class="btn-categorias" id="btn-categorias">
                        <strong>Categorías</strong>
                        <i class="bi bi-chevron-down"></i>
                    </div>
                    <div class="contenedor-enlaces-directos">
                        <a class="direct__links" href="{{url('/')}}">Inicio</a>
                        <a class="direct__links" href="{{url('/products')}}">Tienda</a>
                        <a class="direct__links" href="#">Contacto</a>
                        <div class="content__user" id="content-user">
                            <li class="user__list">
                                @if (Auth::guest())
                                    <button class="user__opt" id ="user-opt">Cuenta <i class="bi bi-chevron-down"></i></button>
                                    <ul class = "drop__list" id="drop-list">
                                        <li><a class = "user__link" href="{{url('/login')}}">Iniciar sesión</a></li>
                                        <li><a class = "user__link" href="{{url('/register')}}">Registrarse</a></li>
                                    </ul>
                                @else
                                    @if(Auth::user() -> id_tasks == 2)
                                        <button class="user__opt" id ="user-opt">{{Auth::user() -> name}} <i class="bi bi-chevron-down"></i></button>
                                        <ul class = "drop__list" id="drop-list">
                                            <li><a class = "user__link" href="{{url('/profile')}}">Mi perfil</a></li>
                                            <li><a class = "user__link" href="{{url('/admin')}}">Panel de control</a></li>
                                            <li><a class = "user__link" href="{{url('/logout')}}">Cerrar Sesión</a></li>
                                        </ul>
                                    @else
                                        <button class="user__opt" id ="user-opt">{{Auth::user() -> name}} <i class="bi bi-chevron-down"></i></button>
                                        <ul class = "drop__list" id="drop-list">
                                            <li><a class = "user__link" href="{{url('/profile')}}">Mi perfil</a></li>
                                            <li><a class = "user__link" href="{{url('/logout')}}">Cerrar Sesión</a></li>
                                        </ul>
                                    @endif
                                @endif
                            </li>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contenedor contenedor-grid">
                <div class="grid" id="grid">
                    <div class="categorias">
                        <button class="btn-regresar"><i class="fas fa-arrow-left"></i> Regresar</button>
                        <h3 class="subtitulo">Categorias</h3>                    
                        @foreach ($categories as $category)
                        <a href="#" data-categoria="{{$category->name}}">{{$category->name}} <i class="bi bi-caret-right-fill"></i></a>
                        @endforeach  
                    </div>
    
                    <div class="contenedor-subcategorias">
                        <div class="subcategoria">
                            <div class="enlaces-subcategoria">
                                <button class="btn-regresar"><i class="fas fa-arrow-left"></i>Regresar</button>
                                <h3 data-categoria="" id="subtitulo" class="subtitulo item-subcategoria"></h3>
                                @foreach ($subcategories as $subcategory)
                                <a data-categoria="{{$subcategory -> category_name}}" class="item-subcategoria" href="{{url('/products?subcategory='.$subcategory -> slug)}}">{{$subcategory -> name}}</a>
                                @endforeach 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div class="progress-bar" id="progress-bar"></div>
        @yield('content')

    <footer>
        <div class="footer-top">
           <div class="container">
              <div class="row gy-5">
                 <div class="col-md-4">
                    <h4 class="logo-text">Lissome</h4>
                    <p>Praesent vulputate neque nec sem fermentum porttitor. Mauris eget dolor convallis, trista, dignissim sapien. Duis vel felis dictu</p>
                    <div class="social-icons">
                       <a href="#"><i class="bx bxl-facebook"></i></a>
                       <a href="#"><i class="bx bxl-twitter"></i></a>
                       <a href="#"><i class="bx bxl-instagram"></i></a>
                       <a href="#"><i class="bx bxl-github"></i></a>
                    </div>
                 </div>
                 <div class="col-md-2">
                    <h5 class="title-sm">Navigation</h5>
                    <div class="footer-links">
                       <a href="#">Services</a>
                       <a href="#">Our Work</a>
                       <a href="#">Team</a>
                       <a href="#">Blog</a>
                    </div>
                 </div>
                 <div class="col-md-2">
                    <h5 class="title-sm">More</h5>
                    <div class="footer-links">
                       <a href="#">FAQ's</a>
                       <a href="#">Privacy & Policy</a>
                       <a href="#">Liscences</a>
                    </div>
                 </div>
                 <div class="col-md-2">
                    <h5 class="title-sm">Contact</h5>
                    <div class="footer-links">
                       <p class="">{{Config::get('configuracion-global.address')}}</p>
                       <p class="">{{Config::get('configuracion-global.contact_phone')}}</p>
                       <p class="">{{Config::get('configuracion-global.contact_email')}}</p>
                    </div>
                 </div>
              </div>
           </div>
        </div>
        <div class="footer-bottom">
           <div class="container">
              <div class="row justify-content-between gy-3">
                 <div class="col-md-6">
                    <p class="mb-0">© Agency2021. All rights reserved</p>
                 </div>
                 <div class="col-auto">
                    
                 </div>
              </div>
           </div>
        </div>
     </footer>
    <!--JS layout-->
    <script src="{{ url('static/js/layout.js') }}"></script>
    <!--JS Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    @yield('JS')
</body>
</html>