<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>empresa | @yield('title')</title>

    <!--CSS-->
        <!--CSS Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
        <!--Componente para urls absolutas-->
        <link rel="stylesheet" href="{{ url('/static/css/layout.css') }}">
        <!--CSS Bootstrap Icons-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css" integrity="sha512-1fPmaHba3v4A7PaUsComSM4TBsrrRGs+/fv0vrzafQ+Rw+siILTiJa0NtFfvGeyY5E182SDTaF5PqP+XOHgJag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<nav class="menu" id="menu">
        <div class="contenedor seccion-superior-nav">
            <div class="contenedor-logo-nav">
                <img src="{{url('/static/images/logo.png')}}" alt="">
            </div>
            <div class="contenedor-busq-nav ">
                <div class="busqueda-box input-group">
                    <input type="text" class="form-control" placeholder="Busca aquí...">
                    <button class="btn-buscar-nav btn btn-outline-secondary" type="button" id=""><i class="bi bi-search"></i></button>
                </div>               
            </div>
            <div class="contenedor-opt-usr">
                <div class="contenedor-cuenta">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                            Cuenta
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">                          
                            <li><a class="dropdown-item" href="{{url('/login')}}">Iniciar sesión</a></li>
                            <li><a class="dropdown-item" href="{{url('/register')}}">Registrarse</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{url('/logout')}}">Salir <i class="bi bi-box-arrow-right"></i></a></li>
                        </ul>
                    </li>
                </div>
                <div class="contenedor-carrito">
                    <div class=""><a href="#"><i class="bi bi-bag"></i></a></div>
                    <div class=""><div class="contador-carrito">0</div></div>
                </div>
            </div>
        </div>
        <div class="contenedor contenedor-btn-nav">
            <button id="btn-barras-nav" class="btn-barras-nav">
                <i class="bi bi-list"></i>
            </button>
            <button id="btn-close-nav" class=" btn-close-nav">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div id="contenedor-enlaces-nav" class="contenedor contenedor-enlaces-nav">
            <div class="btn-categorias" id="btn-categorias">
                <strong>Categorías</strong>
                <i class="bi bi-chevron-down"></i>
            </div>
            <div class="contenedor-enlaces-directos">
                <a href="#">Inicio</a>
                <a href="#">Tienda</a>
                <a href="#">¿Quienes somos?</a>
                <a href="#">Contacto</a>
            </div>
        </div>

        <div class="contenedor contenedor-grid">
            <div class="grid" id="grid">
                <div class="categorias-box">
                    <button class="btn-regresar"><i class="bi bi-arrow-left"></i> Atrás</button>
                    <h3 class="subtitulo">Categorías</h3>
                    <ul class="lista-enlaces">
                        <li class="item-lista"><a href="#"  data-categoria="electronico" class="enlaces-lista">Electrónico<i class="bi bi-chevron-right"></i></a></li>
                        <li class="item-lista"><a href="#" data-categoria="refrigeracion" class="enlaces-lista">Refrigeración<i class="bi bi-chevron-right"></i></a></li>
                        <li class="item-lista"><a href="#" data-categoria="herramientas" class="enlaces-lista">Herramientas<i class="bi bi-chevron-right"></i></a></li>
                        <li class="item-lista"><a href="#" data-categoria="materiales" class="enlaces-lista">Materiales<i class="bi bi-chevron-right"></i></a></li>
                    </ul>
                </div>
                <div class="subcategorias-box">
                    <div class="subcategoria" data-categoria="electronico">
                        <div class="enlaces-subcategoria">
                            <button class="btn-regresar"><i class="bi bi-arrow-left"></i> Atrás</button>
                            <h3 class="subtitulo">Electrónico</h3>
                            <ul class="lista-enlaces">
                                <li class="item-lista"><a href="#" class="enlaces-lista">Electrodomesticos</a></li>
                                <li class="item-lista"><a href="#" class="enlaces-lista">Herramientas</a></li>
                                <li class="item-lista"><a href="#" class="enlaces-lista">Iluminación</a></li>
                            </ul>
                        </div>
                        <div class="banner-subcategoria">
                            <div class="banner-box">
                                <img src="{{url('/static/images/default.jpg')}}" alt="">
                            </div>
                        </div>
                        <div class="galeria-subcategoria">
                            <div class="img-box"><img src="{{url('/static/images/default.jpg')}}" alt=""></div>
                            <div class="img-box"><img src="{{url('/static/images/default.jpg')}}" alt=""></div>
                            <div class="img-box"><img src="{{url('/static/images/default.jpg')}}" alt=""></div>
                            <div class="img-box"><img src="{{url('/static/images/default.jpg')}}" alt=""></div>
                        </div>
                    </div>
                    <div class="subcategoria" data-categoria="refrigeracion">
                        <div class="enlaces-subcategoria">
                            <button class="btn-regresar"><i class="bi bi-arrow-left"></i> Atrás</button>
                            <h3 class="subtitulo">Refrigeración</h3>
                            <ul class="lista-enlaces">
                                <li class="item-lista"><a href="#" class="enlaces-lista">Paneles</a></li>
                                <li class="item-lista"><a href="#" class="enlaces-lista">Coolers</a></li>
                                <li class="item-lista"><a href="#" class="enlaces-lista">Aislantes termicos</a></li>
                            </ul>
                        </div>
                        <div class="banner-subcategoria">
                            <div class="banner-box">
                                <img src="{{url('/static/images/default.jpg')}}" alt="">
                            </div>
                        </div>
                        <div class="galeria-subcategoria">
                            <div class="img-box"><img src="{{url('/static/images/default.jpg')}}" alt=""></div>
                            <div class="img-box"><img src="{{url('/static/images/default.jpg')}}" alt=""></div>
                            <div class="img-box"><img src="{{url('/static/images/default.jpg')}}" alt=""></div>
                            <div class="img-box"><img src="{{url('/static/images/default.jpg')}}" alt=""></div>
                        </div>
                    </div>
                    <div class="subcategoria" data-categoria="herramientas">
                        <div class="enlaces-subcategoria">
                            <button class="btn-regresar"><i class="bi bi-arrow-left"></i> Atrás</button>
                            <h3 class="subtitulo">Herramientas</h3>
                            <ul class="lista-enlaces">
                                <li class="item-lista"><a href="#" class="enlaces-lista">Sierras</a></li>
                                <li class="item-lista"><a href="#" class="enlaces-lista">Taladros</a></li>
                                <li class="item-lista"><a href="#" class="enlaces-lista">Martillos</a></li>
                            </ul>
                        </div>
                        <div class="banner-subcategoria">
                            <div class="banner-box">
                                <img src="{{url('/static/images/default.jpg')}}" alt="">
                            </div>
                        </div>
                        <div class="galeria-subcategoria">
                            <div class="img-box"><img src="{{url('/static/images/default.jpg')}}" alt=""></div>
                            <div class="img-box"><img src="{{url('/static/images/default.jpg')}}" alt=""></div>
                            <div class="img-box"><img src="{{url('/static/images/default.jpg')}}" alt=""></div>
                            <div class="img-box"><img src="{{url('/static/images/default.jpg')}}" alt=""></div>
                        </div>
                    </div>
                    <div class="subcategoria" data-categoria="materiales">
                        <div class="enlaces-subcategoria">
                            <button class="btn-regresar"><i class="bi bi-arrow-left"></i> Atrás</button>
                            <h3 class="subtitulo">Materiales</h3>
                            <ul class="lista-enlaces">
                                <li class="item-lista"><a href="#" class="enlaces-lista">Cemento</a></li>
                                <li class="item-lista"><a href="#" class="enlaces-lista">Hormigón</a></li>
                                <li class="item-lista"><a href="#" class="enlaces-lista">Grava</a></li>
                            </ul>
                        </div>
                        <div class="banner-subcategoria">
                            <div class="banner-box">
                                <img src="{{url('/static/images/default.jpg')}}" alt="">
                            </div>
                        </div>
                        <div class="galeria-subcategoria">
                            <div class="img-box"><img src="{{url('/static/images/default.jpg')}}" alt=""></div>
                            <div class="img-box"><img src="{{url('/static/images/default.jpg')}}" alt=""></div>
                            <div class="img-box"><img src="{{url('/static/images/default.jpg')}}" alt=""></div>
                            <div class="img-box"><img src="{{url('/static/images/default.jpg')}}" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </nav>
    <div>
        @yield('content')
    </div>
    <footer>
        <h2>footer</h2>
    </footer>
    <!--JS layout-->
    <script src="{{ url('static/js/layout.js') }}"></script>
    <!--JS Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>