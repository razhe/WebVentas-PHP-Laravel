@extends('layout')

@section('CSS')
    <!--Css-->
        <link rel="stylesheet" href="{{url('static/css/profile.css')}}">
@endsection

@section('title', 'Perfil')

@section('content')
    <div class="main-perfil">
        <div class="contenedor-alerta">
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
        </div>
        <div class="contenedor-perfil">
            <div class="navegacion-perfil">
                <div class="item-navegacion">
                    <button id="pefil-principal" class="boton-seccion-perfil"><i class="fa-solid fa-user-gear"></i><span>Perfil</span></button>
                </div>
                <div class="item-navegacion">
                    <button id="pefil-contraseña" class="boton-seccion-perfil"><i class="fa-solid fa-lock"></i><span>Contraseña</span></button>
                </div>
                <div class="item-navegacion">
                    <button id="pefil-direcciones" class="boton-seccion-perfil"><i class="fa-solid fa-map-location-dot"></i><span>Direcciones</span></button>
                </div>
                <div class="item-navegacion">
                    <button id="pefil-compras" class="boton-seccion-perfil"><i class="fa-solid fa-box-archive"></i><span>Historial</span></button>
                </div>
            </div>
            <div class="contenido-perfil">
                <div id="box-perfil-principal" class="box-perfil-principal box-contenido">
                    <h4>¡Hola: {{Auth::user()-> name}}!</h4>
                    <form class="register__form needs-validation" action="{{url('/profile/update-profile')}}" method="post" novalidate>
                        @csrf
                        <!--Nombre-->
                        <div class="2-columns-row row mt-4">
                            <div class="input__container col-md-6">
                                <label for="name">Nombre:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-user"></i>
                                    </span>
                                    <input type="text" value="{{Auth::user() -> name}}" name="name" class="form-control" required>
                                </div>
                            </div>
                            <!--Apellido-->
                            <div class="input__container col-md-6">
                                <label for="last_name">Apellido:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-user"></i>
                                    </span>
                                    <input type="text" value="{{Auth::user() -> last_name}}" name="last_name" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <!--Telefono-->
                        <div class="input__container mt-4">
                            <label for="phone">Número telefónico:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa-solid fa-phone"></i>
                                </span>
                                <input type="text" value="{{Auth::user() -> phone}}" name="phone" class="form-control" required>
                            </div>
                        </div>
                        <!--Email-->
                        <div class="input__container mt-4">
                            <label for="email">Correo electrónico:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>
                                <input type="email" value="{{Auth::user() -> email}}" name="email" class="form-control" disabled>
                            </div>
                        </div>
                        <button type="submit" class="btn-default-yellow mt-3">Actualizar datos</button>
                    </form>
                </div>
                <div id="box-contraseña" class="box-contraseña box-contenido">
                    <h4>Cambiar contraseña</h4>
                    <form class="register__form needs-validation" action="{{url('/profile/update-password')}}" method="post" novalidate>
                        @csrf
                        <!--Contraseña actual-->
                        <div class="input__container mt-2">
                            <label for="apassword">Contraseña actual:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa-solid fa-lock"></i>
                                </span>
                                <input type="password" name="apassword" class="form-control" required>
                            </div>
                        </div>

                        <div class="input__container mt-2">
                            <label for="password">Nueva contraseña:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa-solid fa-unlock"></i>
                                </span>
                                <input type="password" placeholder="" name="password" class="form-control" required>
                            </div>
                        </div>
                        <!--Contraseña 2-->
                        <div class="input__container mt-2">
                            <label for="cpassword">Confirme contraseña:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa-solid fa-unlock"></i>
                                </span>
                                <input type="password" placeholder="" name="cpassword" class="form-control" required>
                            </div>
                        </div>
                        <input type="submit" name="actualizar_contraseña" value="Actualizar contraseña" class="btn-default-yellow mt-4">
                    </form>
                </div>

                <div id="box-direcciones-listar" class="box-direcciones box-contenido">
                    <button type="button" id="btn-agregar-direccion" class="btn-default-yellow">Agregar direccion <i class="fa-solid fa-location-dot"></i></button>
                    <p class="tag-min-advertencia">Solo se puede tener un máximo de 2 direcciones registradas.</p>
                    @foreach ($direcciones as $direccion)
                        <div class="item-direccion">
                            <div class="titulo-item-direccion"><span>{{$direccion -> address}}</span><i class="fa-solid fa-chevron-down"></i></div>
                            <div class="contenido-direccion">
                                <p>Dirección: <span>{{$direccion -> address}}</span></p>
                                <p>Edificio recidencial: <span>{{$direccion -> residency}}</span></p>
                                <p>Región: <span>{{$direccion -> comuna_name}}</span></p>
                                <p>Comuna: <span>{{$direccion -> region_name}}</span></p>

                                <div class="opciones-direccion">
                                    <form action="{{url('/profile/delete-address')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="address" value="{{Crypt::encryptString($direccion -> id)}}">
                                        <button type="submit" class="btn-default-red">Remover</button>
                                    </form>
                                </div>
                            </div>                                
                        </div>
                    @endforeach
                    
                </div>
                <div id="box-direcciones-agregar" class="box-direcciones box-contenido">
                    <button type="button" id="volver-listar-direcciones" class=""><i class="fa-solid fa-arrow-left-long"></i> Volver</button>
                    <form class="needs-validation" action="{{url('/profile/create-address')}}" method="post" novalidate>
                        @csrf
                         <!--direccion-->
                         <div class="input__container mt-1 p-1">
                            <label for="phone">Dirección:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa-solid fa-location-dot"></i>
                                </span>
                                <input type="text" placeholder="Ej. Número, pasaje, calle/avenida" value="" name="address" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group mt-1 p-1">
                            <label for="inputState">Recidencia:</label>
                            <select id="inputState" name="residency" class="form-control form-select" aria-label="Default select example">
                                <option selected disabled>Seleccione:</option>
                                <option value="8976">Casa</option>
                                <option value="4932">Departamento</option>
                                <option value="3456">Recinto empresarial</option>
                            </select>
                        </div>
                        
                        <div class="row m-0 g-0 fila-locacion">
                            <!--region-->
                            <div class="region-field form-group col-lg-6 col-md-5 mt-1 p-1">
                                <label for="inputState">Región:</label>
                                <select id="select-region" name="region" class="form-control form-select" aria-label="Default select example">
                                    <option value="region-metropolitana" selected>Region Metropolitana</option>
                                </select>
                            </div>
                            <!--comuna-->
                            <div class="comuna-field form-group col-lg-6 col-md-5 mt-1 p-1">
                                <label for="inputState">Comuna:</label>
                                <select id="select-comuna" name="comuna" class="form-control form-select" aria-label="Default select example">
                                    <option selected disabled>Seleccione una región:</option>
                                </select>
                            </div>
                        </div>
                        <span class="tag-min-advertencia">*Por el momento los envíos solo están disponibles para la región metropolitana.</span>
                        <br>
                        <button type="submit" class="btn-default-yellow" id="btn-guardar-direc">Guardar dirección</button>
                    </form>
                </div>
                <div id="box-listar-compras" class="box-tabla-compras box-contenido">
                    <table class="table-history">
                        <thead>
                            <tr>
                                <th>Orden</th>
                                <th>Fecha</th>
                                <th>Total neto</th>
                                <th>IVA</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Emisión</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ordenes as $orden)
                                <tr>
                                    <td>{{$orden -> order_number}}</td>
                                    <td>{{$orden -> fecha}}</td>
                                    <td>{{Config::get('configuracion-global.currency').$orden -> total_neto}}</td>
                                    <td>{{Config::get('configuracion-global.currency').$orden -> iva}}</td>
                                    <td>{{Config::get('configuracion-global.currency').$orden -> total}}</td>
                                    @switch($orden -> status)
                                        @case(1)
                                        <td><span class="status status-pending">Pago pendiente</span></td>
                                            @break
                                        @case(2)
                                        <td><span class="status status-paid">Confirmada</span></td>
                                            @break
                                    @endswitch
                                    @if (!empty($orden -> id_boleta))
                                        <td>Boleta</td>
                                    @else
                                        <td>Factura</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$ordenes -> links()}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('JS')
    <!--JS-->
        <script src="{{url('static/js/profile.js')}}"></script>
@endsection