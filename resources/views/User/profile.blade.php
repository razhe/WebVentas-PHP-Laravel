@extends('layout')

@section('CSS')
    <!--Css-->
        <link rel="stylesheet" href="{{url('static/css/profile.css?v='.time())}}">
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
                    <form class="register__form" id="form-profile-data" action="{{url('/profile/update-profile')}}" method="post">
                        @csrf
                        <div class="row m-0 g-0">
                            <!--nombre-->    
                            <div class="input__container col-lg-6 col-md-6 p-1">    
                                <div class="default-input-form">
                                    <input type="text" name="name" value="{{Auth::user() -> name}}" id="name_user" placeholder="Nombre" class="inpt-default-form" required>
                                    <i class="fa-solid fa-user"></i>
                                    <div id="error_name" class="error_default_input"></div>
                                </div>
                            </div>
                            <!--apellido-->    
                            <div class="input__container col-lg-6 col-md-6 p-1">    
                                <div class="default-input-form">
                                    <input type="text" name="last_name" value="{{Auth::user() -> last_name}}" id="last_name_user"  placeholder="Apellido" class="inpt-default-form" required>
                                    <i class="fa-solid fa-user"></i>
                                    <div id="error_last_name" class="error_default_input"></div>
                                </div>
                            </div>
                        </div>
    
                        <!--phone-->    
                        <div class="input__container input__container__phone p-1"> 
                            <div class="select-phone">
                                <select name="phone_code" id="select_phone_user">
                                    <option value="569">+569</option>
                                    <option value="562">+562</option>
                                </select>  
                            </div>   
                            
                            <div class="default-input-form">
                                <input type="text" name="phone" value="@php
                                    $data = explode("-", Auth::user() -> phone);
                                    echo(e($data[1]))
                                @endphp" id="phone_user"  placeholder="Teléfono" class="inpt-default-form" required>
                                <i class="fa-solid fa-mobile-screen"></i>
                                <div id="error_phone" class="error_default_input"></div>
                            </div>
                        </div>
                        <!--Email-->    
                        <div class="input__container p-1">    
                            <div class="default-input-form">
                                <input type="email" name="email" value="{{Auth::user() -> email}}" id="email_user"  placeholder="Correo" class="inpt-default-form" disabled>
                                <i class="fa-solid fa-envelope"></i>
                                <div id="error_email" class="error_default_input"></div>
                            </div>
                        </div>

                        <button type="submit" id="update-profile-info" class="btn-default-yellow mt-3">Actualizar datos</button>
                    </form>
                </div>
                <div id="box-contraseña" class="box-contraseña box-contenido">
                    <h4>Cambiar contraseña</h4>
                    <form class="register__form" id="form-profile-password" action="{{url('/profile/update-password')}}" method="post">
                        @csrf
                        <!--Actual Contraseña-->
                        <div class="input__container p-1">                                   
                            <div class="default-input-form">
                                <input type="password" name="apassword" placeholder="Contraseña actual" id="apassword" class="inpt-default-form" required>
                                <i class="fa-solid fa-key"></i>
                                <div id="error_apassword_profile" class="error_default_input"></div>
                            </div>
                        </div>

                        <!--nueva Contraseña-->
                        <div class="input__container p-1">                                   
                            <div class="default-input-form">
                                <input type="password" name="password" placeholder="Nueva contraseña" id="npassword" class="inpt-default-form" required>
                                <i class="fa-solid fa-key"></i>
                                <div id="error_npassword_profile" class="error_default_input"></div>
                            </div>
                        </div>

                        <!--Confirmación Contraseña-->
                        <div class="input__container p-1">                                   
                            <div class="default-input-form">
                                <input type="password" name="cpassword" placeholder="Confirmación contraseña" id="cpassword" class="inpt-default-form" required>
                                <i class="fa-solid fa-key"></i>
                                <div id="error_cpassword_profile" class="error_default_input"></div>
                            </div>
                        </div>
                        <input type="submit" name="actualizar_contraseña" id="update-password-profile" value="Actualizar contraseña" class="btn-default-yellow mt-4">
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
                                <p>Comuna: <span>{{$direccion -> comuna_name}}</span></p>
                                <p>Región: <span>{{$direccion -> region_name}}</span></p>

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
                    <form class="" id="form-add-address" action="{{url('/profile/create-address')}}" method="post">
                        @csrf
                        <!--direccion-->    
                        <div class="input__container p-1">    
                            <div class="default-input-form">
                                <input type="text" name="address" id="address"  placeholder="Dirección" class="inpt-default-form" required>
                                <i class="fa-solid fa-location-dot"></i>
                                <div id="error_address" class="error_default_input"></div>
                            </div>
                        </div>

                        <div class="form-group mt-1 p-1">
                            <select name="residency" id="residency"  class="form-control form-select" aria-label="Default select example">
                                <option selected value="" disabled>Residencia...</option>
                                <option value="8976">Casa</option>
                                <option value="4932">Departamento</option>
                                <option value="3456">Recinto empresarial</option>
                            </select>
                            <div id="error_residency" class="error_default_input"></div>
                        </div>
                        
                        <div class="row m-0 g-0">
                            <!--region-->
                            <div class="form-group col-lg-6 col-md-6 mt-1 p-1">
                                <select name="region" id="region" class="form-control form-select" aria-label="Default select example">
                                    <option value="region-metropolitana" selected>Region Metropolitana</option>
                                </select>
                                <div id="error_region" class="error_default_input"></div>
                            </div>

                            <!--comuna-->
                            <div class="form-group col-lg-6 col-md-6 mt-1 p-1">
                                <select name="comuna" id="select-comuna"  class="form-control form-select" aria-label="Default select example">
                                </select>
                                <div id="error_comuna" class="error_default_input"></div>
                            </div>
                        </div>
                        <span class="tag-min-advertencia mt-2">*Por el momento los envíos solo están disponibles para la región metropolitana.</span>
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