$(document).ready(function(){
    //obtener_region();//provisional, descomentar en caso de actualizar envios
    if (!!document.getElementById("comuna_guest")) {
        traerComunasRegMet();//provisional, eliminar en caso de actualizar envios
    }
});

const btnGoPaymentGuest = document.getElementById('btn-go-payment-guest'),
      btnGoPaymentUser = document.getElementById('btn-go-payment-user'),
      btnLoginPayment = document.getElementById('btn-login-user-payment');

let csfr_token = document.getElementsByName('csrf-token')[0].getAttribute('content');
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': csfr_token
	}
});

function traerComunasRegMet() {
    $.ajax({
        url: '../profile/comunas/'+ 7,
        method: 'POST',
        data:{},
        success: function(data) {
            let html = ``;
            html += `<option selected disabled value="">Comuna...</option>`;
            for (let i = 0; i < data.length; i++) {
                html += `
                    <option value="${data[i].id}">${data[i].name}</option>
                `;
            }
            document.getElementById('comuna_guest').innerHTML = html;       
        },
        error: function(error){

        } 
    });
}

/*Validacion del formulario*/

//Inputs

if (!!btnGoPaymentGuest) {//devuelve false si no esta, true si está
    let nombre = document.getElementById('name_guest'),
        apellido = document.getElementById('last_name_guest'),
        telefono = document.getElementById('phone_guest'),
        email = document.getElementById('email_guest'),
        direccion = document.getElementById('address_guest'),
        residencia = document.getElementById('residency_guest'),
        region = document.getElementById('region_guest'),
        comuna = document.getElementById('comuna_guest');

    btnGoPaymentGuest.addEventListener('click', function(){
        let errores = 0;
        //Nombre
        if (nombre.value.trim() === '' || nombre.value.trim() == null) {
            nombre.classList.remove('input-valido');
            nombre.classList.add('input-invalido');
            document.getElementById('error_name').innerHTML = '(*) El nombre es requerido';
            errores++;
        }else{
            nombre.classList.remove('input-invalido');
            nombre.classList.add('input-valido');
            document.getElementById('error_name').innerHTML = '';
        }
        //Apellido
        if (apellido.value.trim() === '' || apellido.value.trim() == null) {
            apellido.classList.remove('input-valido');
            apellido.classList.add('input-invalido');
            document.getElementById('error_last_name').innerHTML = '(*) El apellido es requerido';
            errores++;
        }else{
            apellido.classList.remove('input-invalido');
            apellido.classList.add('input-valido');
            document.getElementById('error_last_name').innerHTML = '';
        }
        //telefono
        if (telefono.value.trim() === '' || telefono.value.trim() == null) {
            telefono.classList.remove('input-valido');
            telefono.classList.add('input-invalido');
            document.getElementById('error_phone').innerHTML = '(*) El teléfono es requerido';
            errores++;
        }
        else if (isNaN(telefono.value) == true) {
            telefono.classList.remove('input-valido');
            telefono.classList.add('input-invalido');
            document.getElementById('error_phone').innerHTML = '(*) El teléfono debe ser un número';
            errores++;
        }else{
            telefono.classList.remove('input-invalido');
            telefono.classList.add('input-valido');
            document.getElementById('error_phone').innerHTML = '';
        }
        //email
        const emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        if (email.value.trim() === '' || email.value.trim() == null) {
            email.classList.remove('input-valido');
            email.classList.add('input-invalido');
            document.getElementById('error_email').innerHTML = '(*) El email es requerido';
            errores++;
        }else if (emailRegex.test(email.value) == false) {
            email.classList.remove('input-valido');
            email.classList.add('input-invalido');
            document.getElementById('error_email').innerHTML = '(*) El email es invalido';
            errores++;
        }else{
            document.getElementById('error_email').innerHTML = '';
            email.classList.remove('input-invalido');
            email.classList.add('input-valido');
        }
        //Direccion
        if (direccion.value.trim() === '' || direccion.value.trim() == null) {
            direccion.classList.remove('input-valido');
            direccion.classList.add('input-invalido');
            document.getElementById('error_address').innerHTML = '(*) La dirección es requerida';
            errores++;
        }else{
            document.getElementById('error_address').innerHTML = '';
            direccion.classList.remove('input-invalido');
            direccion.classList.add('input-valido');
        }
        //residencia
        if (residencia.value.trim() === '' || residencia.value.trim() == null) {
            residencia.classList.remove('input-valido');
            residencia.classList.add('input-invalido');
            document.getElementById('error_residency').innerHTML = '(*) La residencia es requerida';
            errores++;
        }else{
            document.getElementById('error_residency').innerHTML = '';
            residencia.classList.remove('input-invalido');
            residencia.classList.add('input-valido');
        }
        //region
        if (region.value.trim() === '' || region.value.trim() == null) {
            region.classList.remove('input-valido');
            region.classList.add('input-invalido');
            document.getElementById('error_region').innerHTML = '(*) La región es requerida';
            errores++;
        }else{
            document.getElementById('error_region').innerHTML = '';
            region.classList.remove('input-invalido');
            region.classList.add('input-valido');
        }
        //Comuna
        if (comuna.value.trim() === '' || comuna.value.trim() == null) {
            comuna.classList.remove('input-valido');
            comuna.classList.add('input-invalido');
            document.getElementById('error_comuna').innerHTML = '(*) La comuna es requerida';
            errores++;
        }else{
            document.getElementById('error_comuna').innerHTML = '';
            comuna.classList.remove('input-invalido');
            comuna.classList.add('input-valido');
        }

        if (errores == 0) {
            document.getElementById('form-save-guest').submit();
        }
    });
}

if (!!btnGoPaymentUser) {
    btnGoPaymentUser.addEventListener('click',function(){
        document.getElementById('form-save-user').submit();
    })
}

if (!!btnLoginPayment) {
    let email = document.getElementById('email_user'),
    contraseña = document.getElementById('password_user');
    btnLoginPayment.addEventListener('click', (event)=>{
        event.preventDefault()
        let errores = 0;
        //email
        const emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        if (email.value.trim() === '' || email.value.trim() == null) {
            email.classList.remove('input-valido');
            email.classList.add('input-invalido');
            document.getElementById('error_email_user').innerHTML = '(*) El email es requerido';
            errores++;
        }else if (emailRegex.test(email.value) == false) {
            email.classList.remove('input-valido');
            email.classList.add('input-invalido');
            document.getElementById('error_email_user').innerHTML = '(*) El email es invalido';
            errores++;
        }else{
            document.getElementById('error_email_user').innerHTML = '';
            email.classList.remove('input-invalido');
            email.classList.add('input-valido');
        }

        //password
        if (contraseña.value.trim() === '' || contraseña.value.trim() == null) {
            contraseña.classList.remove('input-valido');
            contraseña.classList.add('input-invalido');
            document.getElementById('error_password_user').innerHTML = '(*) El nombre es requerido';
            errores++;
        }else{
            contraseña.classList.remove('input-invalido');
            contraseña.classList.add('input-valido');
            document.getElementById('error_password_user').innerHTML = '';
        }
        if (errores == 0) {
            document.getElementById('form-login-user').submit();
        }
    })
}

