@extends('Admin.masterDashboard')

@section('CSS')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
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
                        <span><i class="bi bi-table me-2"></i></span> Data Table
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
                                            @switch($user -> status)
                                                @case(1)
                                                    <td><strong class="text-success">Activo <i class="bi bi-check-circle"></i></strong></td>
                                                    @break
                                                @case(2)
                                                    <td><strong class="text-warning">Suspendido <i class="bi bi-exclamation-circle"></i></strong></td>
                                                    @break
                                                @case(3)
                                                    <td><strong class="text-danger">Eliminado <i class="bi bi-dash-circle"></i></strong></td>
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
                                            <td class="box-btn-acciones">
                                                <button class="btn btn-warning btn-edit-user" onclick="EditarUsuario({{ $user -> id }})" data-bs-toggle="modal" data-bs-target="#editForm"><i class="bi bi-pen-fill"></i></button>
                                                <form action="{{ url('admin/users/delete', $user -> id) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash2-fill"></i></button>
                                                </form>
                                                
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
        <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

        <script>
        $(document).ready(function() {
            $('#users-table').DataTable();
        } );
        </script>
    @endsection
@endsection