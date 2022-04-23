@extends('Admin.masterDashboard')

@section('CSS')
    <!--CSS-->
        <link rel="stylesheet" href="{{url('static/css/web-config.css?v='.time())}}">
@endsection

@section('title', 'Configuración')

@section('content')
<div class="container-extend">
    <section class="py-3">
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
        <div class="container container__globalconfig">
            <div class="global__config">
                <div class="box__global__config">
                    <div class="title__section">
                        <h3>Configuración global</h3>
                    </div>
                    <form action="{{url('/admin/web-parameters/global-config/save')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="fila-config row m-0 g-0">
                            <div class="col-lg-4"><span>Nombre de la página Web:</span></div>
                            <div class="form-group col-lg-6">
                                <input type="text" value="{{Config::get('configuracion-global.name');}}" name="name" class="form-control" id="" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="fila-config row m-0 g-0">
                            <div class="col-lg-4"><span>Modo de la página:</span></div>
                            <div class="form-group col-lg-6">
                                <select id="" class="form-select category-select" aria-label="Default select example" name="web_status">                               
                                    @if (Config::get('configuracion-global.web_status') == 1)
                                        <option selected value="1">Activa</option>
                                        <option value="2">Mantenimiento</option>
                                    @else
                                        <option value="1">Activa</option>
                                        <option selected value="2">Mantenimiento</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="fila-config row m-0 g-0">
                            <div class="col-lg-4"><span>Número contacto:</span></div>
                            <div class="form-group col-lg-6">
                                <input type="text" value="{{Config::get('configuracion-global.contact_phone');}}" name="contact_phone" class="form-control" id="" placeholder="09-21345214">
                            </div>
                        </div>
                        <div class="fila-config row m-0 g-0">
                            <div class="col-lg-4"><span>Correo contacto:</span></div>
                            <div class="form-group col-lg-6">
                                <input type="text" value="{{Config::get('configuracion-global.contact_email');}}" name="contact_email" class="form-control" id="" placeholder="example@yourdomain.com">
                            </div>
                        </div>
                        <div class="fila-config row m-0 g-0">
                            <div class="col-lg-4"><span>Correo post ventas:</span></div>
                            <div class="form-group col-lg-6">
                                <input type="text" value="{{Config::get('configuracion-global.post_sales_email');}}" name="post_sales_email" class="form-control" id="" placeholder="example@yourdomain.com">
                            </div>
                        </div>
                        <div class="fila-config row m-0 g-0">
                            <div class="col-lg-4"><span>Dirección:</span></div>
                            <div class="form-group col-lg-6">
                                <input type="text" value="{{Config::get('configuracion-global.address');}}" name="address" class="form-control" id="" placeholder="Av. Los salvadores, #455">
                            </div>
                        </div>
                        <div class="fila-config row m-0 g-0">
                            <div class="col-lg-4"><span>Logo:</span></div>
                            <div class="contenedor-logo form-group col-lg-6">
                                <input type="file" value="" name="logo" class="form-control">
                                <img class="img-logo" src="{{asset(Config::get('configuracion-global.logo'))}}" alt="">
                            </div>
                        </div>
                        <div class="title__section">
                            <h3>Categorías especiales - Home</h3>
                        </div>
                        <div class="fila-config row m-0 g-0">
                            <div class="col-lg-4"><span>Cantidad productos <strong>(Mas vendidos)</strong>:</span></div>
                            <div class="form-group col-lg-6">
                                <select id="" class="form-select category-select" aria-label="Default select example" name="quant_best_sellers_home">
                                    @switch(Config::get('configuracion-global.quant_best_sellers_home'))
                                        @case(4)
                                            <option selected value="4">Mostrar cuatro productos</option>
                                            <option value="8">Mostrar ocho productos</option>
                                            <option value="12">Mostrar doce productos</option>
                                            <option value="16">Mostrar dieciséis productos</option>
                                            @break
                                        @case(8)
                                            <option value="4">Mostrar cuatro productos</option>
                                            <option selected value="8">Mostrar ocho productos</option>
                                            <option value="12">Mostrar doce productos</option>
                                            <option value="16">Mostrar dieciséis productos</option>
                                            @break
                                        @case(12)
                                            <option value="4">Mostrar cuatro productos</option>
                                            <option value="8">Mostrar ocho productos</option>
                                            <option selected value="12">Mostrar doce productos</option>
                                            <option value="16">Mostrar dieciséis productos</option>
                                            @break
                                            
                                        @case(16)
                                            <option value="4">Mostrar cuatro productos</option>
                                            <option value="8">Mostrar ocho productos</option>
                                            <option value="12">Mostrar doce productos</option>
                                            <option selected value="16">Mostrar dieciséis productos</option>
                                            @break
                                    
                                        @default
                                            
                                    @endswitch                               
                                </select>
                            </div>
                        </div>
                        <div class="fila-config row m-0 g-0">
                            <div class="col-lg-4"><span>Cantidad productos <strong>(Ofertas)</strong>:</span></div>
                            <div class="form-group col-lg-6">
                                <select id="" class="form-select category-select" aria-label="Default select example" name="quant_oferts_home">                               
                                    @switch(Config::get('configuracion-global.quant_oferts_home'))
                                    @case(4)
                                        <option selected value="4">Mostrar cuatro productos</option>
                                        <option value="8">Mostrar ocho productos</option>
                                        <option value="12">Mostrar doce productos</option>
                                        <option value="16">Mostrar dieciséis productos</option>
                                        @break
                                    @case(8)
                                        <option value="4">Mostrar cuatro productos</option>
                                        <option selected value="8">Mostrar ocho productos</option>
                                        <option value="12">Mostrar doce productos</option>
                                        <option value="16">Mostrar dieciséis productos</option>
                                        @break
                                    @case(12)
                                        <option value="4">Mostrar cuatro productos</option>
                                        <option value="8">Mostrar ocho productos</option>
                                        <option selected value="12">Mostrar doce productos</option>
                                        <option value="16">Mostrar dieciséis productos</option>
                                        @break
                                        
                                    @case(16)
                                        <option value="4">Mostrar cuatro productos</option>
                                        <option value="8">Mostrar ocho productos</option>
                                        <option value="12">Mostrar doce productos</option>
                                        <option selected value="16">Mostrar dieciséis productos</option>
                                        @break
                                
                                    @default
                                        
                                @endswitch
                                </select>
                            </div>
                        </div>
                        <div class="title__section">
                            <h3>Categorías especiales - catalogo produtos</h3>
                        </div>
                        <div class="fila-config row m-0 g-0">
                            <div class="col-lg-4"><span>Cantidad productos <strong>(Mas vendidos)</strong>:</span></div>
                            <div class="form-group col-lg-6">
                                <input type="text" value="{{Config::get('configuracion-global.quant_best_sellers_catalog')}}" name="quant_best_sellers_catalog" class="form-control" id="" placeholder="Ej. 20">
                            </div>
                        </div>
                        <div class="fila-config row m-0 g-0">
                            <div class="col-lg-4"><span>Cantidad productos <strong>(OFertas)</strong>:</span></div>
                            <div class="form-group col-lg-6">
                                <input type="text" value="{{Config::get('configuracion-global.quant_oferts_catalog')}}" name="quant_oferts_catalog" class="form-control" id="" placeholder="Ej. 20">
                            </div>
                        </div>
                        <div class="title__section">
                            <h3>Configuración de catálogo de productos</h3>
                        </div>
                        <div class="fila-config row m-0 g-0">
                            <div class="col-lg-4"><span>Productos por página:</span></div>
                            <div class="form-group col-lg-6">
                                <input type="text" value="{{Config::get('configuracion-global.products_per_page')}}" name="products_per_page" class="form-control" id="" placeholder="Ej. 20">
                            </div>
                        </div>
                        <div class="title__section">
                            <h3>Ajustes de compra</h3>
                        </div>
                        <div class="fila-config row m-0 g-0">
                            <div class="col-lg-4"><span>Moneda:</span></div>
                            <div class="form-group col-lg-6">
                                <input type="text" value="{{Config::get('configuracion-global.currency');}}" name="currency" class="form-control" id="" placeholder="CLP, USD, CNH, Etc... ">
                            </div>
                        </div>
                        <div class="fila-config row m-0 g-0">
                            <div class="col-lg-4"><span>IVA:</span></div>
                            <div class="form-group col-lg-6">
                                <div class="input-group">
                                    <input type="text" name="iva" value="{{Config::get('configuracion-global.iva')}}" class="form-control" id="" placeholder="Ej.20">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="title__section">
                            <h3>Métodos de pago</h3>
                        </div>
                        <div class="fila-config row m-0 g-0">
                            <div class="col-lg-4"><span>WebPay:</span></div>
                            <div class="switch-box col-lg-6">
                                @if (Config::get('configuracion-global.WebPay') == 'activo')
                                    <input type="checkbox" id="btn-webpay" class="btn_switch" name="WebPay" value="activo" checked>
                                @else
                                    <input type="checkbox" id="btn-webpay" class="btn_switch" name="WebPay" value="activo">
                                @endif
                                <label for="btn-webpay" class="lbl-switch">
                                </label>
                            </div>
                        </div>
                        <div class="fila-config row m-0 g-0">
                            <div class="col-lg-4"><span>Transferencia bancaria:</span></div>
                            <div class="switch-box col-lg-6">
                                @if (Config::get('configuracion-global.Trasnferencia-bancaria') == 'activo')
                                    <input type="checkbox" id="btn-transferencia" class="btn_switch" name="Trasnferencia-bancaria" value="activo" checked>
                                @else
                                    <input type="checkbox" id="btn-transferencia" class="btn_switch" name="Trasnferencia-bancaria" value="activo">
                                @endif
                                <label for="btn-transferencia" class="lbl-switch">
                                </label>
                            </div>
                        </div>
                        <div class="btn-globalconfig-box">
                            <button class="btn btn-success" type="submit">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('JS')
    
@endsection