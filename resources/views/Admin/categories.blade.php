@extends('Admin.masterDashboard')

@section('CSS')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
@endsection

@section('title', 'Productos')

@section('content')
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="register__form needs-validation" action="{{url('/admin/categories')}}" method="post" novalidate>
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
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Aceptar</button>
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

    <div class="row container-datatable">
        <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> Data Table
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="categories-table" class="table table-striped data-table" style="width: 100%">
                        <div class="btns-table">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <i class="bi bi-plus-lg"></i> Agregar
                            </button>
                        </div>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Estado</th>
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
    <script src="{{url('/static/js/admin.js')}}"></script>
    <script>
    $(document).ready(function() {
        $('#categories-table').DataTable();
        editor_init('description-area');
    } ); 
    </script>
@endsection