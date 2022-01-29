
@extends('Admin.masterDashboard')

@section('CSS')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
@endsection

@section('title', 'Productos')

@section('content')

    <!-- Modal agregar -->
    <div class="modal fade" id="modalProductAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Agregar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="register__form needs-validation" action="{{url('/admin/products')}}" method="post" novalidate>
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
                        <!--Precio y descuento-->
                        <div class="2-columns-row row mb-2">
                            <div class="input__container col-md-6">
                                <label for="price">Precio:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="bi bi-currency-dollar"></i>
                                    </span>
                                    <input type="number" name="price" id="price" class="form-control" required>
                                </div>
                            </div>
                            <div class="input__container col-md-6">
                                <label for="discount">Descuento:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="bi bi-percent"></i>
                                    </span>
                                    <input type="text" name="discount" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <!--Marca y stock-->
                        <div class="2-columns-row row mb-2">
                            <div class="input__container col-md-6">
                                <label for="brand">Marca:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="bi bi-tag-fill"></i>
                                    </span>
                                    <input type="text" name="brand" class="form-control" required>
                                </div>
                            </div>
                            <div class="input__container col-md-6">
                                <label for="stock">Stock:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="bi bi-boxes"></i>
                                    </span>
                                    <input type="text" name="stock" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <!--SKU-->
                        <div class="input__container mb-2">
                            <label for="sku">SKU:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="bi bi-upc"></i>
                                </span>
                                <input type="text" name="sku" class="form-control" required>
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
                        <!--Categoria-->
                        <div class="input__container mb-2">
                            <label for="category">Seleccione una categoría:</label>
                            <select id="select-category-add" class="form-select category-select" aria-label="Default select example" name="category">
                            </select>
                        </div>
                        <!--Subcategoria-->
                        <div class="input__container mb-2">
                            <label for="category">Seleccione una subcategoría:</label>
                            <select id="select-subcategory-add" class="form-select subcategoria-select" aria-label="Default select example" name="category">
                                <option selected disabled>Seleccione una categoría primero...</option>
                            </select>
                        </div>
                        <!--Descripción-->
                        <div class="input__container mb-2"">
                            <label for="description">Descripción:</label>
                            <div class="form-floating">
                                <textarea name="description" class="form-control" placeholder="" id="description-area"></textarea>
                            </div>
                        </div>
                        
                        <!--Imagen-->
                        <div class="mb-2">
                            <label for="image" class="form-label">Imagen:</label>
                            <input class="form-control" type="file" name="image" id="image">
                        </div>
                        <!--certificado-->
                        <div class="mb-2">
                            <label for="certificate" class="form-label">Certificado:</label>
                            <input class="form-control" type="file" name="certificate" id="certificate">
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
    <div class="modal fade" id="modalProductEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Editar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="register__form needs-validation" action="{{url('/admin/products')}}" method="post" novalidate>
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
                        <!--Precio y descuento-->
                        <div class="2-columns-row row mb-2">
                            <div class="input__container col-md-6">
                                <label for="price">Precio:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="bi bi-currency-dollar"></i>
                                    </span>
                                    <input type="number" name="price" id="price" class="form-control" required>
                                </div>
                            </div>
                            <div class="input__container col-md-6">
                                <label for="discount">Descuento:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="bi bi-percent"></i>
                                    </span>
                                    <input type="text" name="discount" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <!--Marca y stock-->
                        <div class="2-columns-row row mb-2">
                            <div class="input__container col-md-6">
                                <label for="brand">Marca:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="bi bi-tag-fill"></i>
                                    </span>
                                    <input type="text" name="brand" class="form-control" required>
                                </div>
                            </div>
                            <div class="input__container col-md-6">
                                <label for="stock">Stock:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="bi bi-boxes"></i>
                                    </span>
                                    <input type="text" name="stock" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <!--SKU-->
                        <div class="input__container mb-2">
                            <label for="sku">SKU:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="bi bi-upc"></i>
                                </span>
                                <input type="text" name="sku" class="form-control" required>
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
                        <!--Categoria-->
                        <div class="input__container mb-2">
                            <label for="category">Seleccione una categoría:</label>
                            <select id="select-category-edit" class="form-select category-select" aria-label="Default select example" name="category">
                            </select>
                        </div>
                        <!--Subcategoria-->
                        <div class="input__container mb-2">
                            <label for="category">Seleccione una subcategoría:</label>
                            <select id="select-subcategory-edit" class="form-select subcategoria-select" aria-label="Default select example" name="category">
                                <option selected disabled>Seleccione una categoría primero...</option>
                            </select>
                        </div>
                        <!--Descripción-->
                        <div class="input__container mb-2"">
                            <label for="description">Descripción:</label>
                            <div class="form-floating">
                                <textarea name="description" class="form-control" placeholder="" id="description-area"></textarea>
                            </div>
                        </div>
                        
                        <!--Imagen-->
                        <div class="mb-2">
                            <label for="image" class="form-label">Imagen:</label>
                            <input class="form-control" type="file" name="image" id="image">
                        </div>
                        <!--certificado-->
                        <div class="mb-2">
                            <label for="certificate" class="form-label">Certificado:</label>
                            <input class="form-control" type="file" name="certificate" id="certificate">
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
                        <table id="products-table" class="table table-striped data-table" style="width: 100%">
                            <div class="btns-table">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalProductAdd">
                                    <i class="bi bi-plus-lg"></i> Agregar
                                </button>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalProductEdit">
                                    <i class="bi bi-plus-lg"></i> editar
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
@endsection

@section('JS')
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <!--CKeditor (Darle formato a los text áreas)-->
    <script src="{{url('/static/libs/ckeditor/ckeditor.js')}}"></script>
    <script>
    $(document).ready(function() {
        $('#products-table').DataTable();
        editor_init('description-area');
        traerCategorias();
    } ); 
    
    </script>
@endsection