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
                        <div class="col-lg-4 col-md-6 d-flex stat my-3">
                            <div class="mx-auto">
                                <h6 class="text-muted">Total de ventas</h6>
                                <h3 class="font-weight-bold">@if(!empty($metrics[0] -> total_ventas)) {{$metrics[0] -> total_ventas}} @else 0 @endif</h3>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 d-flex stat my-3">
                            <div class="mx-auto">
                                <h6 class="text-muted">Ventas pagadas</h6>
                                <h3 class="font-weight-bold">@if(!empty($metrics[0] -> activos)) {{$metrics[0] -> activos}} @else 0 @endif</h3>
                                
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 d-flex stat my-3">
                            <div class="mx-auto">
                                <h6 class="text-muted">Ventas pendientes</h6>
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
    <div class="row container-datatable">
        <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> Tabla de productos
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="btns-table">
                    </div>
                    <table id="products-table" class="table table-striped data-table" style="width: 100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Número orden</th>
                                <th>Subtotal</th>
                                <th>IVA</th>
                                <th>Total</th>
                                <th>Fecha</th>
                                <th>Tipo de cuenta</th>
                                <th>Documento de emisión</th>
                                <th>Estado</th>
                                <th>Check</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($ventas as $venta)
                            <tr>
                                <td><small>{{$venta-> id}}</small></td>
                                <td><small>{{$venta-> order_number}}</small></td>
                                <td><small>{{$venta-> total_neto}}</small></td>
                                <td><small>{{$venta-> iva}}</small></td>
                                <td><small>{{$venta-> total}}</small></td>
                                <td><small>{{$venta-> fecha}}</small></td>
                                @if (!empty($venta -> id_user))
                                    <td>
                                        <small>Usuario</small>
                                    </td>
                                @else
                                    <td>
                                        <small>Visitante</small>
                                    </td>
                                @endif
                                @if (!empty($venta -> id_boleta))
                                    <td>
                                        <small>Boleta</small>
                                    </td>
                                @else
                                    <td>
                                        <small>Factura</small>
                                    </td>
                                @endif
                                @switch($venta-> status)
                                    @case(1)
                                        <td>
                                            <div class="">
                                                <form action="{{url('admin/sales/change-order-status')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="cv" value="{{Crypt::encryptString($venta-> id)}}">
                                                    <select id="" onchange="this.form.submit();"  name="order_status" class="form-select brand-select" aria-label="Default select example" name="">
                                                        <option value="1" selected><small>Pendiente</small></option>
                                                        <option value="5">Cancelada</option>
                                                    </select>
                                                </form>
                                            </div>
                                        </td>
                                        @break
                                    @case(2)
                                        <td>
                                            <div class="">
                                                <form action="{{url('admin/sales/change-order-status')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="cv" value="{{Crypt::encryptString($venta-> id)}}">
                                                    <select id="" onchange="this.form.submit();"  name="order_status" class="form-select brand-select" aria-label="Default select example" name="">
                                                        <option value="2" selected>Autorizado</option>
                                                        <option value="3">En despacho</option>
                                                        <option value="4" >Entregado</option>
                                                        <option value="5">Cancelada</option>
                                                    </select>
                                                </form>
                                            </div>
                                        </td>
                                        @break
                                    @case(3)
                                        <td>
                                            <div class="">
                                                <form action="{{url('admin/sales/change-order-status')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="cv" value="{{Crypt::encryptString($venta-> id)}}">
                                                    <select id="" onchange="this.form.submit();" name="order_status" class="form-select brand-select" aria-label="Default select example" name="">
                                                        <option value="2">Autorizado</option>
                                                        <option value="3" selected >En despacho</option>
                                                        <option value="4" >Entregado</option>
                                                        <option value="5">Cancelada</option>
                                                    </select>
                                                </form>
                                            </div>
                                        </td>
                                        @break
                                    @case(4)
                                        <td>
                                            <div class="">
                                                <form action="{{url('admin/sales/change-order-status')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="cv" value="{{Crypt::encryptString($venta-> id)}}">    
                                                    <select id="" onchange="this.form.submit();" name="order_status" class="form-select brand-select" aria-label="Default select example" name="">
                                                        <option value="2">Autorizado</option>
                                                        <option value="3">En despacho</option>
                                                        <option value="4" selected>Entregado</option>
                                                    </select>
                                                </form>
                                            </div>
                                        </td>
                                        @break
                                    @case(5)
                                        <td>
                                           <small>Cancelada</small>
                                        </td>
                                        @break
                                @endswitch
                                @if ($venta -> opened == 0)
                                    <td>
                                        <small>No chequeado</small>
                                    </td>
                                @else
                                    <td>
                                        <small>Chequeado</small>
                                    </td>
                                @endif
                                <td>
                                    <form action="{{url('admin/sale-detail')}}" method="get">
                                        <input type="hidden" name="cv" value="{{Crypt::encryptString($venta-> id)}}">
                                        <button class="btn btn-primary" type="submit">Ver</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach   
                    </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Número orden</th>
                                <th>Subtotal</th>
                                <th>IVA</th>
                                <th>Total</th>
                                <th>Fecha</th>
                                <th>Tipo de cuenta</th>
                                <th>Documento de emisión</th>
                                <th>Estado</th>
                                <th>Check</th>
                                <th>Acción</th>
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
<script src="{{url('static/js/sales.js')}}"></script>
<script type="text/javascript" src="{{url('\static\libs\DataTables\datatables.min.js')}}"></script>
    <script>
    $(document).ready(function() {
        $('#products-table').DataTable({
            "order": [[ 5, "desc" ]],
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