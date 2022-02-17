
@extends('Admin.masterDashboard')

@section('CSS')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
@endsection

@section('title', 'Productos')

@section('content')

    <!-- Modal Agregar categoria-->
    <div class="modal fade" id="addForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Agregar Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="modal-form" class="register__form needs-validation" enctype="multipart/form-data" action="{{url('admin/categories/add')}}" method="post" novalidate>
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
                        <!--Estado-->
                        <div class="input__container mb-2">
                            <label for="status">Seleccione un estado:</label>
                            <select class="form-select" aria-label="Default select example" name="status">
                                <option selected disabled>Estado...</option>
                                <option value="1">Público</option>
                                <option value="2">Borrador</option>
                            </select>
                        </div>
                        <!--banner-->
                        <div class="mb-2">
                            <label for="banner" class="form-label">Imagen:</label>
                            <input class="form-control" type="file" name="banner" id="image" accept="image/*">
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
    <!-- Modal Editar categoria-->
    <div class="modal fade" id="editForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Editar Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="modal-form" class="register__form needs-validation" enctype="multipart/form-data" action="{{url('admin/categories/edit')}}" method="post" novalidate>
                        @csrf
                        <input id="id-categoria-editar" type="hidden" name="id" class="form-control">
                        <!--Nombre-->
                        <div class="input__container mb-2">
                            <label for="name">Nombre:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="bi bi-tag"></i>
                                </span>
                                <input id="nombre-categoria-editar" type="text" name="name" class="form-control" required>
                            </div>
                        </div>
                        <!--Estado-->
                        <div class="input__container mb-2">
                            <label for="status">Seleccione un estado:</label>
                            <select id="estado-categoria-editar" class="form-select" aria-label="Default select example" name="status">
                                <option selected disabled>Estado...</option>
                                <option value="1">Público</option>
                                <option value="2">Borrador</option>
                            </select>
                        </div>
                        <!--Banner-->
                        <div class="mb-2">
                            <label for="banner" class="form-label">Imagen:</label>
                            <input class="form-control" type="file" name="banner" id="image" accept="image/*">
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
                    <span><i class="bi bi-table me-2"></i></span> Tabla de categorías
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="categories-table" class="table table-striped data-table" style="width: 100%">
                            <div class="btns-table">
                                <button type="button" class="btn btn-primary btn-agregar" data-bs-toggle="modal" data-bs-target="#addForm">
                                    <i class="bi bi-plus-lg"></i> Agregar
                                </button>
                            </div>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                    <th>Banner</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{$category -> id}}</td>
                                        <td>{{$category -> name}}</td>
                                        @switch($category-> status)
                                            @case(1)
                                                <td>
                                                    <div class="box-status-active">
                                                        <p>Público</p>
                                                    </div>
                                                </td>
                                                @break
                                            @case(2)
                                                <td>
                                                    <div class="box-status-suspended">
                                                        <p>Borrador</p>
                                                    </div>
                                                </td>
                                                @break
                                        @endswitch
                                        <td><img src="{{asset($category -> banner)}}" alt="" class="img-fluid" style="max-width: 90px; max-height: 60px"></td>
                                        <td>
                                            <div class="box-btn-acciones">
                                                <button onclick="editarCategoria({{ $category -> id }})" id="btn-editar" class="btn btn-edit" data-bs-toggle="modal" data-bs-target="#editForm" type="submit"><i class="bi bi-pen-fill"></i></button>
                                            
                                                <form action="{{ url('admin/categories/delete', $category -> id) }}" method="post">
                                                    @csrf 
                                                    <button class="btn btn-delete" type="submit"><i class="bi bi-trash2-fill"></i></button>
                                                </form>  
                                            </div>                                              
                                        </td>
                                    </tr>
                                    
                                @endforeach                       
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                    <th>Banner</th>
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
            $('#categories-table').DataTable({
                language: {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Registros del _START_ al _END_ de un total de _TOTAL_. ",
                "infoEmpty": "Registros del 0 al 0 de un total de 0. ",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
			     "sProcessing":"Procesando...",
            },
            //para usar los botones
            responsive: "true",
            });
        } );
    </script>
@endsection