@extends('Admin.masterDashboard')

@section('title', 'Dashboard')
@section('content')
    <div class="container-extend">
        <section class="title-box py-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-8">
                    <h1 class="font-weight-bold mb-0">Bienvenido {{Auth::user()->name}}</h1>
                    <p class="lead text-muted">Revisa la última información de la Web</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-mix py-3">
            <div class="container">
                <div class="card rounded-0">
                    <div class="card-body">
                        <div class="row">
                            @if (count($metricasVentas) > 1)
                                <div class="col-lg-3 col-md-6 d-flex stat my-3">
                                    <div class="mx-auto">
                                        <h6 class="text-muted">Contraste ingresos (Men)</h6>
                                        <h3 class="font-weight-bold">{{Config::get('configuracion-global.currency'). ' ' . $metricasVentas[0] -> total_mes}}</h3>     
                                        @if (round((($metricasVentas[0] -> total_mes - $metricasVentas[1] -> total_mes) / $metricasVentas[1] -> total_mes) * 100) > 0)
                                            <h6 class="text-success"><i class="bi bi-arrow-up-circle-fill"></i> {{round((($metricasVentas[0] -> total_mes - $metricasVentas[1] -> total_mes) / $metricasVentas[1] -> total_mes) * 100)}} %</h6>
                                        @else
                                            <h6 class="text-danger"><i class="bi bi-arrow-down-circle-fill"></i> {{round((($metricasVentas[0] -> total_mes - $metricasVentas[1] -> total_mes) / $metricasVentas[1] -> total_mes) * 100)}} %</h6>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 d-flex stat my-3">
                                    <div class="mx-auto">
                                        <h6 class="text-muted">Contraste ventas (Men)</h6>
                                        <h3 class="font-weight-bold">{{$metricasVentas[0] -> ventas}}</h3>                                  
                                        @if (round((($metricasVentas[0] -> ventas - $metricasVentas[1] -> ventas) / $metricasVentas[1] -> ventas) * 100) > 0)
                                            <h6 class="text-success"><i class="bi bi-arrow-up-circle-fill"></i> {{round((($metricasVentas[0] -> ventas - $metricasVentas[1] -> ventas) / $metricasVentas[1] -> ventas) * 100)}} %</h6>
                                        @else
                                            <h6 class="text-danger"><i class="bi bi-arrow-down-circle-fill"></i> {{round((($metricasVentas[0] -> ventas - $metricasVentas[1] -> ventas) / $metricasVentas[1] -> ventas) * 100)}} %</h6>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 d-flex stat my-3">
                                    <div class="mx-auto">
                                        <h6 class="text-muted">Contraste productos vendidos (Men)</h6>
                                        <h3 class="font-weight-bold">{{$metricasVentas[0] -> productos_vendidos}}</h3>
                                        @if (round((($metricasVentas[0] -> productos_vendidos - $metricasVentas[1] -> productos_vendidos) / $metricasVentas[1] -> productos_vendidos) * 100) > 0)
                                            <h6 class="text-success"><i class="bi bi-arrow-up-circle-fill"></i> {{round((($metricasVentas[0] -> productos_vendidos - $metricasVentas[1] -> productos_vendidos) / $metricasVentas[1] -> productos_vendidos) * 100)}} %</h6>
                                        @else
                                            <h6 class="text-danger"><i class="bi bi-arrow-down-circle-fill"></i> {{round((($metricasVentas[0] -> productos_vendidos - $metricasVentas[1] -> productos_vendidos) / $metricasVentas[1] -> productos_vendidos) * 100)}} %</h6>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-3 col-md-6 d-flex stat my-3">
                                    <div class="mx-auto">
                                        <h6 class="text-muted">Contraste ingresos (Men)</h6>
                                        <h3 class="font-weight-bold">{{Config::get('configuracion-global.currency'). ' ' .$metricasVentas[0] -> total_mes}}</h3>
                                        <h6 class="text-secondary"><i class="bi bi-dash-circle-fill"></i> 0%</h6>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 d-flex stat my-3">
                                    <div class="mx-auto">
                                        <h6 class="text-muted">Contraste ventas (Men)</h6>
                                        <h3 class="font-weight-bold">{{$metricasVentas[0] -> ventas}}</h3>
                                        <h6 class="text-secondary"><i class="bi bi-dash-circle-fill"></i> 0%</h6>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 d-flex stat my-3">
                                    <div class="mx-auto">
                                        <h6 class="text-muted">Contraste productos vendidos (Men)</h6>
                                        <h3 class="font-weight-bold">{{$metricasVentas[0] -> productos_vendidos}}</h3>
                                        <h6 class="text-secondary"><i class="bi bi-dash-circle-fill"></i> 0%</h6>
                                    </div>
                                </div>
                            @endif
                            @if (count($metricasUsuarios) > 1)
                                <div class="col-lg-3 col-md-6 d-flex my-3">
                                    <div class="mx-auto">
                                        <h6 class="text-muted">Usuarios nuevos (Men)</h6>
                                        <h3 class="font-weight-bold">{{$metricasUsuarios[0] -> usuarios}}</h3>
                                        @if (round((($metricasUsuarios[0] -> usuarios - $metricasUsuarios[1] -> usuarios) / $metricasUsuarios[1] -> usuarios) * 100) > 0)
                                            <h6 class="text-success"><i class="bi bi-arrow-up-circle-fill"></i> {{round((($metricasUsuarios[0] -> usuarios - $metricasUsuarios[1] -> usuarios) / $metricasUsuarios[1] -> usuarios) * 100)}} %</h6>
                                        @else
                                            <h6 class="text-danger"><i class="bi bi-arrow-down-circle-fill"></i> {{round((($metricasUsuarios[0] -> usuarios - $metricasUsuarios[1] -> usuarios) / $metricasUsuarios[1] -> usuarios) * 100)}} %</h6>
                                        @endif
                                        
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-3 col-md-6 d-flex my-3">
                                    <div class="mx-auto">
                                        <h6 class="text-muted">Usuarios nuevos (Men)</h6>
                                        <h3 class="font-weight-bold">{{$metricasUsuarios[0] -> usuarios}}</h3>
                                        <h6 class="text-secondary"><i class="bi bi-dash-circle-fill"></i>0%</h6>                                    
                                    </div>
                                </div>
                            @endif
                        </div>
                        <span>Contraste del ultimo y penultimo mes registrado.</span>
                    </div>
                </div>
            </div>
        </section>

        <div class="row container-charts">
            <div class="col-md-6 mb-3 chart-box">
                <div class="card h-100">
                    <div class="card-header">
                        <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                        Ventas efectuadas durante el año
                    </div>
                    <div class="card-body">
                        <canvas class="chart" id="chart-sales-per-year" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3 chart-box">
                <div class="card h-100">
                    <div class="card-header">
                        <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                        Productos vendidos durante el año
                    </div>
                    <div class="card-body">
                        <canvas class="chart" id="chart-sold-products" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="last_sells-box ">
            <div class="card rounded-0">
                <div class="card-header bg-light">
                    <h6 class="font-weight-bold mb-0">Ventas recientes</h6>
                </div>
                <div class="card-body pt-2">
                    @foreach ($ordenes as $orden)
                        <a href="" class="enlace-nueva-venta">
                            <div class="d-flex border-bottom py-2 item-nueva-venta">
                                <div class="d-flex mr-3">
                                    <h2 class="align-self-center mb-0"><i class="icon ion-md-pricetag"></i></h2>
                                </div>
                                <div class="align-self-center">
                                    <h6 class="d-inline-block mb-0">{{Config::get('configuracion-global.currency').' '. $orden->total}}</h6>
                                    <small class="d-block text-muted">Num. {{$orden -> order_number .' ~ '. $orden-> fecha}}</small>
                                </div>
                                @if ($orden -> opened == 0)
                                    <div class="status_venta status-nuevo"><small>¡Nuevo!</small></div>
                                @else
                                    <div class="status_venta status-abierto"><small>Abierto</small></div>
                                @endif
                            </div>
                        </a>
                    @endforeach    
                    <a href="{{url('admin/sales')}}"><button class="btn btn-primary w-100">Ver todas</button></a>
                </div>
            </div>
        </div>
@endsection

@section('JS')
    <script src="{{url('static/js/dashboard.js')}}"></script>
@endsection