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
                    <button id="pefil-principal" class="boton-seccion-perfil"><i class="bi bi-person-bounding-box"></i><span>Perfil</span></button>
                </div>
                <div class="item-navegacion">
                    <button id="pefil-contraseña" class="boton-seccion-perfil"><i class="bi bi-shield-lock"></i><span>Contraseña</span></button>
                </div>
                <div class="item-navegacion">
                    <button id="pefil-direcciones" class="boton-seccion-perfil"><i class="bi bi-signpost-split"></i><span>Direcciones</span></button>
                </div>
                <div class="item-navegacion">
                    <button id="pefil-compras" class="boton-seccion-perfil"><i class="bi bi-clipboard-check"></i><span>Mis compras</span></button>
                </div>
            </div>
            <div class="contenido-perfil">
                <div id="box-perfil-principal" class="box-perfil-principal box-contenido">
                    <h4>¡Hola: {{Auth::user()-> name}}!</h4>
                    <form class="register__form needs-validation" action="{{url('/profile/update-profile')}}" method="post" novalidate>
                        @csrf
                        <!--Nombre-->
                        <div class="2-columns-row row mt-1">
                            <div class="input__container col-md-6">
                                <label for="name">Nombre:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input type="text" value="{{Auth::user() -> name}}" name="name" class="form-control" required>
                                </div>
                            </div>
                            <!--Apellido-->
                            <div class="input__container col-md-6">
                                <label for="last_name">Apellido:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="bi bi-person-fill"></i>
                                    </span>
                                    <input type="text" value="{{Auth::user() -> last_name}}" name="last_name" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <!--Telefono-->
                        <div class="input__container mt-1">
                            <label for="phone">Numero telefónico:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="bi bi-telephone"></i>
                                </span>
                                <input type="text" value="{{Auth::user() -> phone}}" name="phone" class="form-control" required>
                            </div>
                        </div>
                        <!--Email-->
                        <div class="input__container mt-1">
                            <label for="email">Correo electrónico:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input type="email" value="{{Auth::user() -> email}}" name="email" class="form-control" disabled>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mt-3">Guardar</button>
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
                                    <i class="bi bi-key"></i>
                                </span>
                                <input type="password" name="apassword" class="form-control" required>
                            </div>
                        </div>

                        <div class="input__container mt-2">
                            <label for="password">Nueva contraseña:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="bi bi-shield-lock"></i>
                                </span>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                        <!--Contraseña 2-->
                        <div class="input__container mt-2">
                            <label for="cpassword">Confirme contraseña:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="bi bi-shield-lock-fill"></i>
                                </span>
                                <input type="password" name="cpassword" class="form-control" required>
                            </div>
                        </div>
                        <input type="submit" name="actualizar_contraseña" value="Actualizar contraseña" class="btn btn-success mt-4">
                    </form>
                </div>

                <div id="box-direcciones-listar" class="box-direcciones box-contenido">
                    <button type="button" id="btn-agregar-direccion" class="btn btn-primary">Agregar direccion</button>
                    <p>Solo se puede tener un máximo de 2 direcciones registradas.</p>
                    @foreach ($direcciones as $direccion)
                        <div class="item-direccion">
                            <div class="titulo-item-direccion"><span>{{$direccion -> address}}</span><i class="bi bi-chevron-down"></i></div>
                            <div class="contenido-direccion">
                                <p>Dirección: <span>{{$direccion -> address}}</span></p>
                                <p>Edificio recidencial: <span>{{$direccion -> residency}}</span></p>
                                <p>Región: <span>{{$direccion -> comuna_name}}</span></p>
                                <p>Comuna: <span>{{$direccion -> region_name}}</span></p>

                                <div class="opciones-direccion">
                                    <form action="{{url('/profile/delete-address')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="address" value="{{Crypt::encryptString($direccion -> id)}}">
                                        <button type="submit">Remover</button>
                                    </form>
                                </div>
                            </div>                                
                        </div>
                    @endforeach
                    
                </div>
                <div id="box-direcciones-agregar" class="box-direcciones box-contenido">
                    <button type="button" id="volver-listar-direcciones" class="btn btn-primary">Volver</button>
                    <form class="register__form needs-validation" action="{{url('/profile/create-address')}}" method="post" novalidate>
                        @csrf
                         <!--direccion-->
                         <div class="input__container mt-1">
                            <label for="phone">Dirección:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="bi bi-compass"></i>
                                </span>
                                <input type="text" placeholder="Ej. Número, pasaje, calle/avenida" value="" name="address" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group mt-1">
                            <label for="inputState">Recidencia:</label>
                            <select id="inputState" name="residency" class="form-control form-select" aria-label="Default select example">
                                <option selected disabled>Seleccione:</option>
                                <option value="8976">Casa</option>
                                <option value="4932">Departamento</option>
                                <option value="3456">Recinto empresarial</option>
                            </select>
                        </div>
                        
                        <div class="row m-0 g-0">
                            <!--region-->
                            <div class="form-group col-lg-6 col-md-6 mt-1">
                                <label for="inputState">Región:</label>
                                <select id="select-region" name="region" class="form-control form-select" aria-label="Default select example">
                                    <option value="region-metropolitana" selected>Region Metropolitana</option>
                                </select>
                            </div>
                            <!--comuna-->
                            <div class="form-group col-lg-6 col-md-6 mt-1">
                                <label for="inputState">Comuna:</label>
                                <select id="select-comuna" name="comuna" class="form-control form-select" aria-label="Default select example">
                                    <option selected disabled>Seleccione una región:</option>
                                </select>
                            </div>
                        </div>
                        <span>*Por el momento los envíos solo están disponibles para la región metropolitana.</span>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </form>
                </div>
                <div id="box-listar-compras" class="box-direcciones box-contenido">
                    <table>
                        <thead>
                            <tr>
                                <th>Orden</th>
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
                                    <td>{{$orden -> total_neto}}</td>
                                    <td>{{$orden -> iva}}</td>
                                    <td>{{$orden -> total}}</td>
                                    @switch($orden -> status)
                                        @case(1)
                                        <td>Pago pendiente</td>
                                            @break
                                        @case(2)
                                        <td>Pagada</td>
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