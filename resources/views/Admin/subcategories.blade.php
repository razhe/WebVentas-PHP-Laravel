
@extends('Admin.masterDashboard')

@section('CSS')
    <link rel="stylesheet" type="text/css" href="{{url('static\libs\DataTables\datatables.min.css?v='.time())}}"/>
@endsection

@section('title', 'Productos')

@section('content')

    <div class="container-extend">
        <section class="bg-mix py-3">
            <div class="container">
                <div class="card rounded-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 d-flex stat my-3">
                                <div class="mx-auto">
                                    <h6 class="text-muted">Total de subcategorias</h6>
                                    <h3 class="font-weight-bold">@if(!empty($metrics[0] -> total_subcategorias)) {{$metrics[0] -> total_subcategorias}} @else 0 @endif</h3>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 d-flex stat my-3">
                                <div class="mx-auto">
                                    <h6 class="text-muted">Subcategorias públicas</h6>
                                    <h3 class="font-weight-bold">@if(!empty($metrics[0] -> activos)) {{$metrics[0] -> activos}} @else 0 @endif</h3>
                                    
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 d-flex stat my-3">
                                <div class="mx-auto">
                                    <h6 class="text-muted">Subcategorias borrador</h6>
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

        <!-- Modal Agregar subcategoria-->
        <div class="modal fade" id="addFormSubcateoria" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Agregar Subcategoría</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="modal-form" enctype="multipart/form-data" class="register__form needs-validation" action="{{url('admin/subcategories/add')}}" method="post" novalidate>
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
                            <!--slug-->
                            <div class="input__container mb-2">
                                <label for="slug">Slug:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="bi bi-tag"></i>
                                    </span>
                                    <input type="text" name="slug" placeholder="nombre-separado-por-guiones" class="form-control" required>
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
                            <!--La categoría-->
                            <div class="input__container mb-2">
                                <label for="id_category">Seleccione una categoría:</label>
                                <select id="select-category-add" class="form-select" aria-label="Default select example" name="id_category">

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
        <!-- Modal Editar subcategoria-->
        <div class="modal fade" id="editFormSubcategoria" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Editar Subcategoría</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="modal-form" enctype="multipart/form-data" class="register__form needs-validation" action="{{url('admin/subcategories/edit')}}" method="post" novalidate>
                            @csrf
                            <input id="id-subcategoria-editar" type="hidden" name="id" class="form-control">
                            <!--Nombre-->
                            <div class="input__container mb-2">
                                <label for="name">Nombre:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="bi bi-tag"></i>
                                    </span>
                                    <input id="nombre-subcategoria-editar" type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                            <!--slug-->
                            <div class="input__container mb-2">
                                <label for="slug">Slug:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="bi bi-tag"></i>
                                    </span>
                                    <input type="text" id="slug-subcategoria-editar" name="slug" placeholder="nombre-separado-por-guiones" class="form-control" required>
                                </div>
                            </div>
                            <!--Estado-->
                            <div class="input__container mb-2">
                                <label for="status">Seleccione un estado:</label>
                                <select id="estado-subcategoria-editar" class="form-select" aria-label="Default select example" name="status">
                                    <option selected disabled>Estado...</option>
                                    <option value="1">Público</option>
                                    <option value="2">Borrador</option>
                                </select>
                            </div>
                            <!--La categoría-->
                            <div class="input__container mb-2">
                                <label for="id_category">Seleccione una categoría:</label>
                                <select id="select-category-edit" class="form-select" aria-label="Default select example" name="id_category">
                                                                      
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
        <!--subcategorias-->
        <div class="row container-datatable">
            <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <span><i class="bi bi-table me-2"></i></span> Tabla de Subcategorías
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="subcategories-table" class="table table-striped data-table" style="width: 100%">
                            <div class="btns-table">
                                <button type="button" class="btn btn-primary btn-agregar" data-bs-toggle="modal" data-bs-target="#addFormSubcateoria">
                                    <i class="bi bi-plus-lg"></i> Agregar
                                </button>
                            </div>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre subcategoría</th>
                                    <th>Slug</th>
                                    <th>Estado</th>
                                    <th>Categoría padre</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcategories as $subcategory)
                                    <tr>
                                        <td>{{$subcategory -> id}}</td>
                                        <td>{{$subcategory -> name}}</td>
                                        <td>{{$subcategory -> slug}}</td>
                                        @switch($subcategory-> status)
                                            @case(1)
                                                <td>
                                                    <div class="box-status-active">
                                                        <i class="bi bi-eye-fill"></i><strong>Público</strong>
                                                    </div>
                                                </td>
                                                @break
                                            @case(2)
                                                <td>
                                                    <div class="box-status-suspended">
                                                        <i class="bi bi-eye-slash-fill"></i><strong>Borrador</strong>
                                                    </div>
                                                </td>
                                                @break
                                        @endswitch
                                        <td><strong>{{$subcategory -> category_name}}</strong></td>
                                        <td>
                                            <div class="box-btn-acciones">
                                                <button onclick="editarSubCategoria({{ $subcategory -> id }})" id="btn-editar" class="btn btn-edit" data-bs-toggle="modal" data-bs-target="#editFormSubcategoria" type="submit"><i class="bi bi-pen-fill"></i></button>
                                            
                                                <form action="{{ url('admin/subcategories/delete', $subcategory -> id) }}" class="formulario-eliminar-subcategoria" method="post">
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
                                    <th>Nombre subcategoría</th>
                                    <th>Slug</th>
                                    <th>Estado</th>
                                    <th>Categoría padre</th>
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
    <script type="text/javascript" src="{{url('\static\libs\DataTables\datatables.min.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('.formulario-eliminar-subcategoria').submit(function(event){
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
            $('#subcategories-table').DataTable({
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
            });
            traerCategorias();
        } );
    </script>
@endsection