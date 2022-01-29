@extends('Admin.masterDashboard')

@section('CSS')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
@endsection

@section('title', 'Productos')

@section('content')
<!-- Modal agregar -->
<div class="modal fade" id="modalBrandAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar Marca</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="register__form needs-validation" action="{{url('/admin/brands/add')}}" enctype="multipart/form-data" method="post" novalidate>
                    @csrf
                    <!--Nombre-->
                    <div class="input__container mb-2">
                        <label for="name">Nombre:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="bi bi-tag"></i>
                            </span>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                    <!--estado-->
                    <div class="input__container mb-2">
                        <label for="status">Seleccione un estado:</label>
                        <select id="" class="form-select category-select" aria-label="Default select example" name="status">
                            <option value="1">Activo</option>
                            <option value="2">Suspendido</option>
                        </select>
                    </div>                  
                    <!--Imagen-->
                    <div class="mb-2">
                        <label for="image" class="form-label">Imagen:</label>
                        <input class="form-control" type="file" name="image" id="image" accept="image/*">
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal editar -->
<div class="modal fade" id="modalBrandEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Marca</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="register__form needs-validation" enctype="multipart/form-data" action="{{url('/admin/brands/edit')}}" method="post" novalidate>
                    @csrf
                    <!--Nombre-->
                    <input id="id-marca-editar" type="hidden" name="id" class="form-control">
                    <div class="input__container mb-2">
                        <label for="name">Nombre:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="bi bi-tag"></i>
                            </span>
                            <input id="nombre-marca-editar" type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                    <!--estado-->
                    <div class="input__container mb-2">
                        <label for="status">Seleccione un estado:</label>
                        <select id="estado-marca-editar" class="form-select category-select" aria-label="Default select example" name="status">
                            <option value="1">Activo</option>
                            <option value="2">Suspendido</option>
                        </select>
                    </div>                  
                    <!--Imagen-->
                    <div class="mb-2">
                        <label for="image" class="form-label">Imagen:</label>
                        <input class="form-control" type="file" name="image" id="image">
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-warning">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container-extend">
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
    
    <!--Validacion formulario-->
    @if(Session::has('MsgResponse'))
        <div class="container box-msgAuth-error">
            <div class="alert alert-{{ Session::get('typealert') }}" style="display:none;">
            {{Session::get('MsgResponse')}}
            @if($errors -> any())
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
            <script>
                $('.alert').slideDown();
                setTimeout(function() {$('.alert').slideUp();}, 8000);
            </script>
            </div>
        </div>
    @endif
    <div class="row container-datatable">
        <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> Data Table
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="brands-table" class="table table-striped data-table" style="width: 100%">
                        <div class="btns-table">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBrandAdd">
                                <i class="bi bi-plus-lg"></i> Agregar
                            </button>
                        </div>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                                <th>Imagen</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                            <tr>
                                <td>{{$brand -> id}}</td>
                                <td>{{$brand -> name}}</td>
                                @switch($brand -> status)
                                    @case(1)
                                        <td><strong class="text-success">Activo <i class="bi bi-check-circle"></i></strong></td>
                                        @break
                                    @case(2)
                                        <td><strong class="text-warning">Suspendido <i class="bi bi-exclamation-circle"></i></strong></td>
                                        @break
                                @endswitch
                                <td>
                                    <img src="{{asset($brand -> image)}}" alt="{{$brand -> name}}" class="img-fluid" width="60px">
                                </td>
                                <td class="box-btn-acciones">
                                    <button class="btn btn-warning btn-edit-user" onclick="EditarMarca({{$brand -> id}})" data-bs-toggle="modal" data-bs-target="#modalBrandEdit"><i class="bi bi-pen-fill"></i></button>
                                    <form action="{{ url('admin/brands/delete', $brand -> id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash2-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                                <th>Imagen</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

@endsection

@section('JS')
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#brands-table').DataTable();
        
    } ); 
    
    </script>
@endsection