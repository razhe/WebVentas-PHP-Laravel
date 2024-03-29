@extends('Admin.masterDashboard')

@section('CSS')

@endsection

@section('title', 'Ventas')

@section('content')
<div class="container-extend">
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
    <div class=""><a href="{{url('admin/sales')}}"><button>Volver</button></a></div>
    <div class="row m-0">
        <div class="box-section-sales box-detalle col-lg-7 col-md-12">
            <div class="card">
                <div class="card-header">
                    <span><i class="bi bi-table me-2"></i></span> Tabla de venta
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="" class="table table-striped data-table" style="width: 100%">
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
                                        @if ($pagos[0] -> medio_pago == 'Transferencia-bancaria')
                                            @switch($venta-> status)
                                                @case(1)
                                                    <td>
                                                        <div class="">
                                                            <form action="{{url('admin/sales/change-order-status-bankTransfer')}}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="cv" value="{{Crypt::encryptString($venta-> id)}}">
                                                                <select id="" onchange="this.form.submit();"  name="order_status" class="form-select brand-select" aria-label="Default select example" name="">
                                                                    <option value="1" selected><small>Pendiente</small></option>
                                                                    <option value="2">Autorizado</option>
                                                                    <option value="5">Cancelada</option>
                                                                </select>
                                                            </form>
                                                        </div>
                                                    </td>
                                                    @break
                                                @case(2)
                                                    <td>
                                                        <div class="">
                                                            <form action="{{url('admin/sales/change-order-status-bankTransfer')}}" method="post">
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
                                                            <form action="{{url('admin/sales/change-order-status-bankTransfer')}}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="cv" value="{{Crypt::encryptString($venta-> id)}}">
                                                                <select id="" onchange="this.form.submit();" name="order_status" class="form-select brand-select" aria-label="Default select example" name="">
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
                                                            <form action="{{url('admin/sales/change-order-status-bankTransfer')}}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="cv" value="{{Crypt::encryptString($venta-> id)}}">    
                                                                <select id="" onchange="this.form.submit();" name="order_status" class="form-select brand-select" aria-label="Default select example" name="">
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
                                        @else
                                            @switch($venta-> status)
                                                @case(1)
                                                    <td>
                                                        <div class="">
                                                            <form action="{{url('admin/sales/change-order-status-webpay')}}" method="post">
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
                                                            <form action="{{url('admin/sales/change-order-status-webpay')}}" method="post">
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
                                                            <form action="{{url('admin/sales/change-order-status-webpay')}}" method="post">
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
                                                            <form action="{{url('admin/sales/change-order-status-webpay')}}" method="post">
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
                                        @endif
                                    </tr>
                                @endforeach   
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-section-sales box-pagos col-lg-5 col-md-12">
            <div class="card">
                <div class="card-header">
                    <span><i class="bi bi-table me-2"></i></span> Tabla de pago
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="" class="table table-striped data-table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Modo de pago</th>
                                    <th>Medio de pago</th>
                                    <th>Estado del pago</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                                <tbody>
                                @foreach ($pagos as $pago)
                                    <tr>
                                        <td><small>{{$pago-> id}}</small></td>
                                        <td><small>{{$pago-> modo_pago}}</small></td>
                                        <td><small>{{$pago-> medio_pago}}</small></td>
                                        <td><small>{{$pago-> estado_pago}}</small></td>
                                        @if ($pago -> estado_pago == 'AUTHORIZED' && $pago -> medio_pago == 'WebPay')
                                            <td>
                                                <form action="{{url('/transbank/refud-pay')}}" id="form-refund" method="post">
                                                    @csrf
                                                    <input type="hidden" name="amount" value="{{Crypt::encryptString($venta-> total)}}">
                                                    <input type="hidden" name="code" value="{{Crypt::encryptString($pago -> id)}}">
                                                    <input type="hidden" name="token" value="{{Crypt::encryptString($pago -> token)}}">
                                                    <button type="submit" class="btn-default-yellow" id="btn-refund">Reembolsar</button>
                                                </form>
                                            </td>
                                        @else
                                            <td>
                                                <small>No disponible</small>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach   
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row m-0">
        <div class="box-section-sales box-orden">
            <div class="card">
                <div class="card-header">
                    <span><i class="bi bi-table me-2"></i></span> Información del documento emitido
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if (!empty($ventas[0] -> id_boleta))
                            <table id="" class="table table-striped data-table" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Rut</th>
                                        <th>Cliente</th>
                                        <th>Teléfono</th>
                                        <th>Dirección</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                    @foreach ($detalles_documento as $detalle_documento)
                                        <tr>
                                            <td><small>{{$detalle_documento-> id}}</small></td>
                                            <td><small>{{$detalle_documento-> rut}}</small></td>
                                            <td><small>{{$detalle_documento-> client}}</small></td>
                                            <td><small>{{$detalle_documento-> phone}}</small></td>
                                            <td><small>{{$detalle_documento-> address}}</small></td>
                                        </tr>
                                    @endforeach   
                                </tbody>
                            </table>
                        @else
                            <table id="" class="table table-striped data-table" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Rut</th>
                                        <th>Cliente</th>
                                        <th>Razón social</th>
                                        <th>Giro</th>
                                        <th>Teléfono</th>
                                        <th>Comuna</th>
                                        <th>Ciudad</th>
                                        <th>Direccion</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                    @foreach ($detalles_documento as $detalle_documento)
                                        <tr>
                                            <td><small>{{$detalle_documento-> id}}</small></td>
                                            <td><small>{{$detalle_documento-> rut}}</small></td>
                                            <td><small>{{$detalle_documento-> cliente}}</small></td>
                                            <td><small>{{$detalle_documento-> razon_social}}</small></td>
                                            <td><small>{{$detalle_documento-> giro}}</small></td>
                                            <td><small>{{$detalle_documento-> telefono}}</small></td>
                                            <td><small>{{$detalle_documento-> comuna}}</small></td>
                                            <td><small>{{$detalle_documento-> ciudad}}</small></td>
                                            <td><small>{{$detalle_documento-> direccion}}</small></td>
                                        </tr>
                                    @endforeach   
                                </tbody>
                            </table>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row m-0">
        <div class="box-section-sales box-orden">
            <div class="card">
                <div class="card-header">
                    <span><i class="bi bi-table me-2"></i></span> Tabla de detalle
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="" class="table table-striped data-table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Cantidad</th>
                                    <th>Valor (Uni)</th>
                                    <th>Valor (Total)</th>
                                    <th>Producto</th>
                                </tr>
                            </thead>
                                <tbody>
                                @foreach ($Order_has_products as $Order_has_product)
                                    <tr>
                                        <td><small>{{$Order_has_product-> id}}</small></td>
                                        <td><small>{{$Order_has_product-> quantity}}</small></td>
                                        <td><small>{{$Order_has_product-> price}}</small></td>
                                        <td><small>{{$Order_has_product-> total_price}}</small></td>
                                        <td><small>{{$Order_has_product-> product_name}}</small></td>
                                    </tr>
                                @endforeach   
                            </tbody>
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('#form-refund').submit(function(event){
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
</script>
@endsection