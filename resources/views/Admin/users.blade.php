@extends('Admin.masterDashboard')

@section('CSS')
    <link rel="stylesheet" type="text/css" href="{{url('static\libs\DataTables\datatables.min.css?v='.time())}}"/>
@endsection

@section('title', 'Usuarios') 

@section('content')
    <!-- Modal Agregar-->
    <div class="modal fade" id="addForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Agregar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="register__form needs-validation" action="{{url('/admin/users/add')}}" method="post" novalidate>
                        @csrf
                        <!--Nombre y apellido-->
                        <div class="2-columns-row row">
                            <div class="input__container col-md-6">
                                <label for="name">Nombre:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                            <!--Apellido-->
                            <div class="input__container col-md-6">
                                <label for="last_name">Apellido:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="bi bi-person-fill"></i>
                                    </span>
                                    <input type="text" name="last_name" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <!--Telefono-->
                        <div class="input__container">
                            <label for="phone">Numero telefónico:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="bi bi-telephone"></i>
                                </span>
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                        </div>
                        <!--Email-->
                        <div class="input__container">
                            <label for="email">Correo electrónico:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                        <!--Contraseña-->
                        <div class="input__container">
                            <label for="password">Contraseña:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="bi bi-shield-lock"></i>
                                </span>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                        
                        <!--Estado-->
                        <div class="input__container mb-2">
                            <label for="status">Seleccione un estado:</label>
                            <select class="form-select" aria-label="Default select example" name="status">
                                <option selected disabled>Estado...</option>
                                <option value="1">Activo</option>
                                <option value="2">Suspendido</option>
                            </select>
                        </div>
                        <!--Rol-->
                        <div class="input__container mb-2">
                            <label for="id_tasks">Seleccione un rol:</label>
                            <select class="form-select" aria-label="Default select example" name="id_tasks">
                                <option selected disabled>Rol...</option>
                                <option value="1">Usuario</option>
                                <option value="2">Administrador</option>
                            </select>
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

    <!-- Modal editar-->
    <div class="modal fade" id="editForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="register__form needs-validation" action="{{url('admin/users/edit')}}" method="post" novalidate>
                        @csrf
                        <input id="id-editar-usuario" type="hidden" name="id" class="form-control">
                        <!--Nombre y apellido-->
                        <div class="2-columns-row row">
                            <div class="input__container col-md-6">
                                <label for="name">Nombre:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input id="nombre-editar-usuario" type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                            <!--Apellido-->
                            <div class="input__container col-md-6">
                                <label for="last_name">Apellido:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="bi bi-person-fill"></i>
                                    </span>
                                    <input id="apellido-editar-usuario" type="text" name="last_name" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <!--Telefono-->
                        <div class="input__container">
                            <label for="phone">Numero telefónico:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="bi bi-telephone"></i>
                                </span>
                                <input id="telefono-editar-usuario" type="text" name="phone" class="form-control" required>
                            </div>
                        </div>
                        <!--Email-->
                        <div class="input__container">
                            <label for="email">Correo electrónico:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input id="correo-editar-usuario" type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                        <!--Estado-->
                        <div class="input__container mb-2">
                            <label for="status">Seleccione un estado:</label>
                            <select id="estado-editar-usuario" class="form-select" aria-label="Default select example" name="status">
                                <option selected disabled>Estado...</option>
                                <option value="1">Activo</option>
                                <option value="2">Suspendido</option>
                            </select>
                        </div>
                        <!--Rol-->
                        <div class="input__container mb-2">
                            <label for="id_tasks">Seleccione un rol:</label>
                            <select id="rol-editar-usuario" class="form-select" aria-label="Default select example" name="id_tasks">
                                <option selected disabled>Rol...</option>
                                <option value="1">Usuario</option>
                                <option value="2">Administrador</option>
                            </select>
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
                            <div class="col-lg-4 col-md-6 d-flex stat my-3">
                                <div class="mx-auto">
                                    <h6 class="text-muted">Total de usuarios</h6>
                                    <h3 class="font-weight-bold">@if(!empty($metrics[0] -> total_usuarios)) {{$metrics[0] -> total_usuarios}} @else 0 @endif</h3>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 d-flex stat my-3">
                                <div class="mx-auto">
                                    <h6 class="text-muted">Usuarios activos</h6>
                                    <h3 class="font-weight-bold">@if(!empty($metrics[0] -> activos)) {{$metrics[0] -> activos}} @else 0 @endif</h3>
                                    
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 d-flex stat my-3">
                                <div class="mx-auto">
                                    <h6 class="text-muted">Usuarios restringidos</h6>
                                    <h3 class="font-weight-bold">@if(!empty($metrics[0] -> restringidos)) {{$metrics[0] -> restringidos}} @else 0 @endif</h3>
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
        <!--Validacion formulario-->
        @if(Session::has('MsgError'))
            <div class="container box-msgAuth-error">
                <div class="alert alert-{{ Session::get('typealert') }}" style="display:none;">
                {{Session::get('MsgError')}}
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
                        <span><i class="bi bi-table me-2"></i></span> tabla de usuarios
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="users-table" class="table table-striped data-table" style="width: 100%">
                                <div class="btns-table">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addForm">
                                        <i class="bi bi-plus-lg"></i> Agregar
                                    </button>
                                </div>
                                <thead>
                                    <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Email</th>
                                    <th>Telefono</th>
                                    <th>Estado</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{$user -> id}}</td>
                                            <td>{{$user -> name}}</td>
                                            <td>{{$user -> last_name}}</td>
                                            <td>{{$user -> email}}</td>
                                            <td>{{$user -> phone}}</td>
                                            @switch($user-> status)
                                                @case(1)
                                                    <td>
                                                        <div class="box-status-active">
                                                            <i class="bi bi-person-check-fill"></i><strong>Activo</strong>
                                                        </div>
                                                    </td>
                                                    @break
                                                @case(2)
                                                    <td>
                                                        <div class="box-status-suspended">
                                                            <i class="bi bi-person-dash-fill"></i><strong>Suspendido</strong>
                                                        </div>
                                                    </td>
                                                @break
                                            @endswitch
                                            @switch($user -> id_tasks)
                                                @case(1)
                                                    <td><strong class="">Usuario</strong></td>
                                                    @break
                                                @case(2)
                                                    <td><strong class="">Administrador</strong></td>
                                                    @break
                                            @endswitch
                                            <td>
                                                <div class="box-btn-acciones">
                                                    <button class="btn btn-edit" onclick="EditarUsuario({{ $user -> id }})" data-bs-toggle="modal" data-bs-target="#editForm"><i class="bi bi-pen-fill"></i></button>
                                                    <form action="{{ url('admin/users/delete', $user -> id) }}" class="formulario-eliminar-usuario" method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-delete"><i class="bi bi-trash2-fill"></i></button>
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
                                        <th>Apellido</th>
                                        <th>Email</th>
                                        <th>Telefono</th>
                                        <th>Estado</th>
                                        <th>Rol</th>
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

    @section('JS')
        <script type="text/javascript" src="{{url('\static\libs\DataTables\datatables.min.js')}}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
        $('.formulario-eliminar-usuario').submit(function(event){
            event.preventDefault();
            Swal.fire({
            title: '¿Estas seguro?',
            text: "No podrás revertir los cambios.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
        $(document).ready(function() {
            $('#users-table').DataTable({
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
                responsive: true,
                fixedHeader: true,
                dom: 'Bfrtilp',
                buttons:[
                    {
                        extend:     'excelHtml5',
                        text:       '<i class="bi bi-file-earmark-excel"></i>',
                        tittleAttr: 'Exportar a PDF',
                        className : 'btn btn-success'
                    },
                    {
                        extend:     'pdfHtml5',
                        text:       '<i class="bi bi-file-earmark-pdf"></i>',
                        tittleAttr: 'Exportar a Excel',
                        className : 'btn btn-danger'
                    },
                    {
                        extend:     'print',
                        text:       '<i class="bi bi-printer"></i>',
                        tittleAttr: 'Imprimir',
                        className : 'btn btn-secondary'
                    },
                ]
            });
        } );
        </script>
    @endsection
@endsection