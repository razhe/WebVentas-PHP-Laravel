@extends('Admin.masterDashboard')

@section('CSS')
    <link rel="stylesheet" type="text/css" href="{{url('static\libs\DataTables\datatables.min.css')}}"/>
@endsection

@section('title', 'Ventas')

@section('content')
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
</div>
@endsection

@section('JS')
<script type="text/javascript" src="{{url('\static\libs\DataTables\datatables.min.js')}}"></script>
    <script>
    $(document).ready(function() {
        $('#products-table').DataTable({
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