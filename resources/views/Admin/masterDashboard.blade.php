<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>{{Config::get('configuracion-global.name')}} | @yield('title')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="routeName" content="{{ Route::currentRouteName() }}">

    @yield('CSS')
    <!--CSS-->
        <!--CSS Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
        <!--Componente para urls absolutas-->
        <link rel="stylesheet" href="{{ url('/static/css/admin.css?v='.time()) }}">
        <!--CSS Bootstrap Icons-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css" integrity="sha512-1fPmaHba3v4A7PaUsComSM4TBsrrRGs+/fv0vrzafQ+Rw+siILTiJa0NtFfvGeyY5E182SDTaF5PqP+XOHgJag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!--CSS Toastr-->
        <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <!--JS-->
        <!--JQuery-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!--Chart.js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        
</head>
<body>
    <!-- Parte de arriba del navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasExample">
            <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
            </button>
            <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavBar" aria-controls="topNavBar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="topNavBar">
           
            <ul class="navbar-nav d-flex ms-auto my-3 my-lg-0">
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle ms-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-fill"></i> {{Auth::user()->name}}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{url('/')}}">Volver al inicio</a></li>
                    <li>
                    <a class="dropdown-item" href="{{url('/logout')}}">Salir <i class="bi bi-box-arrow-left"></i></a>
                    </li>
                </ul>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <!-- Parte de arriba del navbar -->
    <!-- sidebar offcanvas -->
    <div class="offcanvas offcanvas-start sidebar-nav" tabindex="-1" id="sidebar">
        <div class="offcanvas-body p-0">
            <nav class="navbar-dark">
            <ul class="navbar-nav">
                <li>
                <div class="text-muted small fw-bold text-uppercase px-3">CORE</div>
                </li>
                <li>
                <a href="{{url('/admin')}}" class="nav-link px-3 active">
                    <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                    <span>Dashboard</span>
                </a>
                </li>
                <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
                <li>
                <div class="text-muted small fw-bold text-uppercase px-3 mb-3"> CONTROL </div>
                </li>
                <li>
                    <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#layouts">
                        <span class="me-2"><i class="bi bi-diagram-3"></i></span>
                        <span>Entidades</span>
                        <span class="ms-auto">
                        <span class="right-icon">
                            <i class="bi bi-chevron-down"></i>
                        </span>
                        </span>
                    </a>
                    <div class="collapse" id="layouts">
                        <ul class="navbar-nav ps-3">
                            <li>
                                <a href="{{url('admin/users')}}" class="nav-link px-3">
                                    <span class="me-2"><i class="bi bi-people"></i></span>
                                    <span>Usuarios</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('admin/products')}}" class="nav-link px-3">
                                    <span class="me-2"><i class="bi bi-boxes"></i></span>
                                    <span>Productos</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('admin/brands')}}" class="nav-link px-3">
                                    <span class="me-2"><i class="bi bi-clipboard-check"></i></span>
                                    <span>Marcas</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#objetos">
                        <span class="me-2"><i class="bi bi-archive"></i></span>
                        <span>Objetos</span>
                        <span class="ms-auto">
                        <span class="right-icon">
                            <i class="bi bi-chevron-down"></i>
                        </span>
                        </span>
                    </a>
                    <div class="collapse" id="objetos">
                        <ul class="navbar-nav ps-3">
                            <li>
                                <a href="{{url('admin/categories')}}" class="nav-link px-3">
                                    <span class="me-2"><i class="bi bi-people"></i></span>
                                    <span>Categorías</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('admin/subcategories')}}" class="nav-link px-3">
                                    <span class="me-2"><i class="bi bi-boxes"></i></span>
                                    <span>Subcategorías</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#customize">
                        <span class="me-2"><i class="bi bi-gear"></i></span>
                        <span>Configuración</span>
                        <span class="ms-auto">
                        <span class="right-icon">
                            <i class="bi bi-chevron-down"></i>
                        </span>
                        </span>
                    </a>
                    <div class="collapse" id="customize">
                        <ul class="navbar-nav ps-3">
                            <li>
                                <a href="{{url('admin/web-parameters/config')}}" class="nav-link px-3">
                                    <span class="me-2"><i class="bi bi-globe2"></i></i></span>
                                    <span>Página Web</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('admin/banner')}}" class="nav-link px-3">
                                    <span class="me-2"><i class="bi bi-columns-gap"></i></span>
                                    <span>Banner</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{{url('admin/sales')}}" class="nav-link px-3">
                        <span class="me-2"><i class="bi bi-cash-coin"></i></span>
                        <span>Ventas</span>
                    </a>                
                </li>
                <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
                <li>
            </ul>
            </nav>
        </div>
    </div>
    <!-- sidebar offcanvas -->
    <main class="mt-5">
        @yield('content')
    </main>
    <!--JS Admin-->
    <script src="{{ url('static/js/admin.js') }}"></script>
    <!--JS Bootstrap (primero popper y luego boostrap)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    @yield('JS')
</body>
</html>