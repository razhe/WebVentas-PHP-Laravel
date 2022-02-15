@extends('Email.layout')
@section('content')
    <span>¡Hola <strong>{{$name}}</strong>!</span>
    <p>Se ha creado una solicitud para reestablecer la contraseña de su cuenta registrada en nuestra plataforma.</p>
    <p>(<strong>Importante</strong>: Si usted no creo la solicitud de restablecimiento de contraseña <strong>NO</strong> continue con los siguientes pasos)</p>
    <p>Para continuar, haga click en el siguiente botón e ingrese el siguiente código: <strong>{{$code}}</strong></p>
    <div class="container-btn-reset" style="display: flex; align-items: center; width: 100%;">
        <a href="{{url('/reset?email='.$email)}}" style="width: 35%">
            <button 
                style="height: 40px;
                       width: 100%;
                       font-size: .95rem;
                       background: #232F3E;
                       color: #fff;
                       border: none;
                       outline: none;
                       border-radius: 4px;
                       cursor: pointer;
                       min-width: 100px;">
                Restablecer contraseña
            </button>
        </a>
    </div>
    <p style="color: rgba(0, 0, 0, .5); font-size: .82rem; margin-top: 30px">(Advertencia) El equipo de soporte jamás le pedirá su contraseña.</p>
@endsection