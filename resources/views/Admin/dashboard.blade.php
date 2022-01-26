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
                            <div class="col-lg-3 col-md-6 d-flex stat my-3">
                                <div class="mx-auto">
                                    <h6 class="text-muted">Ingresos mensuales</h6>
                                    <h3 class="font-weight-bold">$50000</h3>
                                    <h6 class="text-success"><i class="bi bi-arrow-up-circle-fill"></i> 50.50%</h6>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 d-flex stat my-3">
                                <div class="mx-auto">
                                    <h6 class="text-muted">Productos activos</h6>
                                    <h3 class="font-weight-bold">100</h3>
                                    <h6 class="text-success"><i class="bi bi-arrow-up-circle-fill"></i> 25.50%</h6>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 d-flex stat my-3">
                                <div class="mx-auto">
                                    <h6 class="text-muted">No. de usuarios</h6>
                                    <h3 class="font-weight-bold">2500</h3>
                                    <h6 class="text-success"><i class="bi bi-arrow-up-circle-fill"></i> 75.50%</h6>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 d-flex my-3">
                                <div class="mx-auto">
                                    <h6 class="text-muted">Usuarios nuevos</h6>
                                    <h3 class="font-weight-bold">500</h3>
                                    <h6 class="text-success"><i class="bi bi-arrow-up-circle-fill"></i> 15.50%</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="row container-charts">
            <div class="col-md-6 mb-3 chart-box">
                <div class="card h-100">
                    <div class="card-header">
                        <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                        Area Chart Example
                    </div>
                    <div class="card-body">
                        <canvas class="chart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3 chart-box">
                <div class="card h-100">
                    <div class="card-header">
                        <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                        Area Chart Example
                    </div>
                    <div class="card-body">
                        <canvas class="chart" width="400" height="200"></canvas>
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
                    <div class="d-flex border-bottom py-2">
                        <div class="d-flex mr-3">
                            <h2 class="align-self-center mb-0"><i class="icon ion-md-pricetag"></i></h2>
                        </div>
                        <div class="align-self-center">
                            <h6 class="d-inline-block mb-0">$250</h6>
                            <small class="d-block text-muted">Curso diseño web</small>
                        </div>
                    </div>
                    <div class="d-flex border-bottom py-2">
                        <div class="d-flex mr-3">
                            <h2 class="align-self-center mb-0"><i class="icon ion-md-pricetag"></i></h2>
                        </div>
                        <div class="align-self-center">
                            <h6 class="d-inline-block mb-0">$250</h6>
                            <small class="d-block text-muted">Curso diseño web</small>
                        </div>
                    </div>
                    <div class="d-flex border-bottom py-2">
                        <div class="d-flex mr-3">
                            <h2 class="align-self-center mb-0"><i class="icon ion-md-pricetag"></i></h2>
                        </div>
                        <div class="align-self-center">
                            <h6 class="d-inline-block mb-0">$250</h6>
                            <small class="d-block text-muted">Curso diseño web</small>
                        </div>
                    </div>
                    <div class="d-flex border-bottom py-2">
                        <div class="d-flex mr-3">
                            <h2 class="align-self-center mb-0"><i class="icon ion-md-pricetag"></i></h2>
                        </div>
                        <div class="align-self-center">
                            <h6 class="d-inline-block mb-0">$250</h6>
                            <small class="d-block text-muted">Curso diseño web</small>
                        </div>
                    </div>
                    <div class="d-flex border-bottom py-2 mb-3">
                        <div class="d-flex mr-3">
                            <h2 class="align-self-center mb-0"><i class="icon ion-md-pricetag"></i></h2>
                        </div>
                        <div class="align-self-center">
                            <h6 class="d-inline-block mb-0">$250</h6>
                            <small class="d-block text-muted">Curso diseño web</small>
                        </div>
                    </div>
                    <button class="btn btn-primary w-100">Ver todas</button>
                </div>
            </div>
        </div>
@endsection