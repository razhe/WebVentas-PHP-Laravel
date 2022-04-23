$(document).ready(function(){
    //obtener_region();//provisional, descomentar en caso de actualizar envios
    traerComunasRegMet();//provisional, eliminar en caso de actualizar envios
    getCurrentSection();
});



const btnPerfilPrincipal = document.getElementById('pefil-principal'),
    btnCambiarContraseña = document.getElementById('pefil-contraseña'),
    btnPerfilDirecciones = document.getElementById('pefil-direcciones'),
    boxDireccionesAgregar = document.getElementById('box-direcciones-agregar'),
    boxDireccionesListar = document.getElementById('box-direcciones-listar'),
    tituloDirecciones = document.getElementsByClassName('titulo-item-direccion'),
    btnAgregarDireccion = document.getElementById('btn-agregar-direccion'),
    btnVolverListar = document.getElementById('volver-listar-direcciones'),
    btnListarCompras = document.getElementById('pefil-compras'),
    btnUpdateInfo = document.getElementById('update-profile-info'),
    btnUpdatePassword = document.getElementById('update-password-profile'),
    btnAddAddress = document.getElementById('btn-guardar-direc');

btnAgregarDireccion.addEventListener('click', function() {
    boxDireccionesListar.classList.remove('activo');
    boxDireccionesAgregar.classList.add('activo');
});
btnVolverListar.addEventListener('click', function() {
    boxDireccionesListar.classList.add('activo');
    boxDireccionesAgregar.classList.remove('activo');
});

for (let i = 0; i < tituloDirecciones.length; i++) {
    tituloDirecciones[i].addEventListener('click', function() {
        this.classList.toggle('activo'); 
    });
}

function saveCurrentSection(id) {
    if (typeof(Storage) != 'undefined') {
        if (sessionStorage.getItem('current_section') != undefined) {

            sessionStorage.removeItem('current_section');
            sessionStorage.setItem('current_section', id);
        }else{
            sessionStorage.setItem('current_section', id);
        }
    }
}
function getCurrentSection(){
    if (sessionStorage.getItem('current_section') != undefined){
        let boxPrincipal = document.getElementById(sessionStorage.getItem('current_section'));
        for (let i = 0; i < cajasContenido.length; i++) {
            cajasContenido[i].classList.remove('activo');
        }
        boxPrincipal.classList.add('activo');
    }else{
        let boxPrincipal = document.getElementById('box-perfil-principal');
        boxPrincipal.classList.add('activo');
    }
    
}

let cajasContenido = document.getElementsByClassName('box-contenido');

btnPerfilPrincipal.addEventListener('click', function(){
    let boxPrincipal = document.getElementById('box-perfil-principal');
    for (let i = 0; i < cajasContenido.length; i++) {
        cajasContenido[i].classList.remove('activo');
    }
    saveCurrentSection('box-perfil-principal');
    boxPrincipal.classList.add('activo');
});
btnCambiarContraseña.addEventListener('click', function(){
    let boxPrincipal = document.getElementById('box-contraseña');
    for (let i = 0; i < cajasContenido.length; i++) {
        cajasContenido[i].classList.remove('activo');
    }
    saveCurrentSection('box-contraseña');
    boxPrincipal.classList.add('activo');
});

btnPerfilDirecciones.addEventListener('click', function(){
    let boxPrincipal = document.getElementById('box-direcciones-listar');
    for (let i = 0; i < cajasContenido.length; i++) {
        cajasContenido[i].classList.remove('activo');
    }
    saveCurrentSection('box-direcciones-listar');
    boxPrincipal.classList.add('activo');
});

btnListarCompras.addEventListener('click', function(){
    let boxPrincipal = document.getElementById('box-listar-compras');
    for (let i = 0; i < cajasContenido.length; i++) {
        cajasContenido[i].classList.remove('activo');
    }
    saveCurrentSection('box-listar-compras');
    boxPrincipal.classList.add('activo');
});

let csfr_token = document.getElementsByName('csrf-token')[0].getAttribute('content');
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': csfr_token
	}
});


//Validaicones

if (!!btnUpdateInfo) {//devuelve false si no esta, true si está
    let nombre = document.getElementById('name_user'),
        apellido = document.getElementById('last_name_user'),
        telefono = document.getElementById('phone_user'),
        email = document.getElementById('email_user'),
        selectPhoneCode = document.getElementById('select_phone_user');

    btnUpdateInfo.addEventListener('click', (e)=>{
        e.preventDefault();
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
            document.getElementById('error_phone').innerHTML = '(*) El teléfono es requerido.';
            errores++;
        }else if (isNaN(telefono.value) == true || telefono.value < 0) {
            telefono.classList.remove('input-valido');
            telefono.classList.add('input-invalido');
            document.getElementById('error_phone').innerHTML = '(*) El teléfono inválido.';
            errores++;
        }
        else if (telefono.value.length != 8) {
            telefono.classList.remove('input-valido');
            telefono.classList.add('input-invalido');
            document.getElementById('error_phone').innerHTML = '(*) El teléfono no posee 8 carácteres.';
            errores++;
        }else{
            document.getElementById('error_phone').innerHTML = '';
            telefono.classList.remove('input-invalido');
            telefono.classList.add('input-valido');
        } 
        
        //codigo telefono
        if (selectPhoneCode.value !== '569' && selectPhoneCode.value !== '562') {
            telefono.classList.remove('input-valido');
            telefono.classList.add('input-invalido');
            document.getElementById('error_phone').innerHTML = '(*) Prefijo no válido.';
            errores++;
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

        if (errores == 0) {
            document.getElementById('form-profile-data').submit();
        }
    })
}

if (!!btnUpdatePassword) {//devuelve false si no esta, true si está
    let contraseña_actual = document.getElementById('apassword'),
        contraseña_nueva = document.getElementById('npassword'),
        contraseña_confirmacion = document.getElementById('cpassword');

    btnUpdatePassword.addEventListener('click', (e)=>{
        e.preventDefault();
        let errores = 0;
        //Contraseña actual
        if (contraseña_actual.value.trim() === '' || contraseña_actual.value.trim() == null) {
            contraseña_actual.classList.remove('input-valido');
            contraseña_actual.classList.add('input-invalido');
            document.getElementById('error_apassword_profile').innerHTML = '(*) La contraseña es requerida.';
            errores++;
        }else if(contraseña_actual.value.length < 8){
            contraseña_actual.classList.remove('input-valido');
            contraseña_actual.classList.add('input-invalido');

            document.getElementById('error_apassword_profile').innerHTML = '(*) La contraseña debe tener mínimo 8 carácteres.'; 
            errores++;
        } else{
            document.getElementById('error_apassword_profile').innerHTML = '';
            contraseña_actual.classList.remove('input-invalido');
            contraseña_actual.classList.add('input-valido');
        }
        //Contraseña nueva
        if (contraseña_nueva.value.trim() === '' || contraseña_nueva.value.trim() == null) {
            contraseña_nueva.classList.remove('input-valido');
            contraseña_nueva.classList.add('input-invalido');
            document.getElementById('error_npassword_profile').innerHTML = '(*) La contraseña es requerida.';
            errores++;
        }else if(contraseña_nueva.value.length < 8){
            contraseña_nueva.classList.remove('input-valido');
            contraseña_nueva.classList.add('input-invalido');

            document.getElementById('error_npassword_profile').innerHTML = '(*) La contraseña debe tener mínimo 8 carácteres.'; 
            errores++;
        } else{
            document.getElementById('error_npassword_profile').innerHTML = '';
            contraseña_nueva.classList.remove('input-invalido');
            contraseña_nueva.classList.add('input-valido');
        }
        //Confirmacion contraseña
        if (contraseña_confirmacion.value.trim() === '' || contraseña_confirmacion.value.trim() == null) {
            contraseña_confirmacion.classList.remove('input-valido');
            contraseña_confirmacion.classList.add('input-invalido');
            document.getElementById('error_cpassword_profile').innerHTML = '(*) La confirmación de la contraseña es requerida.';
            errores++;
        }else if(contraseña_confirmacion.value.length < 8){
            contraseña_confirmacion.classList.remove('input-valido');
            contraseña_confirmacion.classList.add('input-invalido');
            errores++;
        }else if (contraseña_confirmacion.value !== contraseña_confirmacion.value){
            contraseña_confirmacion.classList.remove('input-valido');
            contraseña_confirmacion.classList.add('input-invalido');

            inputPassword.classList.remove('input-valido');
            inputPassword.classList.add('input-invalido');

            document.getElementById('error_cpassword_profile').innerHTML = '(*) Las contraseñas no coinciden.';
            errores++;
        } else{
            document.getElementById('error_cpassword_profile').innerHTML = '';
            contraseña_confirmacion.classList.remove('input-invalido');
            contraseña_confirmacion.classList.add('input-valido');
        }

        if(errores == 0){
            document.getElementById('form-profile-password').submit();
        }
    })
}
if (!!btnAddAddress) {//devuelve false si no esta, true si está
    let inptDir = document.getElementById('address'),
        inptResidencia = document.getElementById('residency'),
        inptComuna = document.getElementById('select-comuna'),
        inptRegion = document.getElementById('region');

    btnAddAddress.addEventListener('click', (e)=>{
        e.preventDefault();
        let errores = 0;
        //Direccion
        if (inptDir.value.trim() === '' || inptDir.value.trim() == null) {
            inptDir.classList.remove('input-valido');
            inptDir.classList.add('input-invalido');
            document.getElementById('error_address').innerHTML = '(*) La dirección es requerida';
            errores++;
        }else{
            document.getElementById('error_address').innerHTML = '';
            inptDir.classList.remove('input-invalido');
            inptDir.classList.add('input-valido');
        }
        //residencia
        if (inptResidencia.value.trim() === '' || inptResidencia.value.trim() == null) {
            inptResidencia.classList.remove('input-valido');
            inptResidencia.classList.add('input-invalido');
            document.getElementById('error_residency').innerHTML = '(*) La residencia es requerida';
            errores++;
        }else{
            document.getElementById('error_residency').innerHTML = '';
            inptResidencia.classList.remove('input-invalido');
            inptResidencia.classList.add('input-valido');
        }
        //region
        if (inptRegion.value.trim() === '' || inptRegion.value.trim() == null) {
            inptRegion.classList.remove('input-valido');
            inptRegion.classList.add('input-invalido');
            document.getElementById('error_region').innerHTML = '(*) La región es requerida';
            errores++;
        }else{
            document.getElementById('error_region').innerHTML = '';
            inptRegion.classList.remove('input-invalido');
            inptRegion.classList.add('input-valido');
        }
        //Comuna
        if (inptComuna.value.trim() === '' || inptComuna.value.trim() == null) {
            inptComuna.classList.remove('input-valido');
            inptComuna.classList.add('input-invalido');
            document.getElementById('error_comuna').innerHTML = '(*) La comuna es requerida';
            errores++;
        }else{
            document.getElementById('error_comuna').innerHTML = '';
            inptComuna.classList.remove('input-invalido');
            inptComuna.classList.add('input-valido');
        }

        if(errores == 0){
            document.getElementById('form-add-address').submit();
        }
    })
}

//Direcciones
//PROVISIONAL / DESCOMENTAR EN CASO DE ACTUALIZAR LOS ENVIOS.
/*
function obtener_region(){
    $.ajax({
        url: "profile/regiones",
        method: 'GET',
        success: function(data) {
            let html = ``;
            for (let i = 0; i < data.length; i++) {
                html += `
                    <option value="${data[i].id}">${data[i].name}</option>
                `;
            }
            document.getElementById('select-region').innerHTML = html;
        },
        error: function(error){

        } 
    });
}

document.getElementById('select-region').addEventListener('change', (event) => {
    let id = event.target.value;
    $.ajax({
        url: 'profile/comunas/'+ id,
        method: 'POST',
        data:{},
        success: function(data) {
            let html = ``;
            html += `<option selected disabled>Ya puede seleccionar:</option>`;
            for (let i = 0; i < data.length; i++) {
                html += `
                    <option value="${data[i].id}">${data[i].name}</option>
                `;
            }
            document.getElementById('select-comuna').innerHTML = html;       
        },
        error: function(error){

        } 
    });
});
*/
//PROVISIONAL / BORRAR EN CASO DE ACTUALIZAR LOS ENVIOS 
function traerComunasRegMet() {
    $.ajax({
        url: 'profile/comunas/'+ 7,
        method: 'POST',
        data:{},
        success: function(data) {
            let html = ``;
            html += `<option selected value="" disabled>Seleccione:</option>`;
            for (let i = 0; i < data.length; i++) {
                html += `
                    <option value="${data[i].id}">${data[i].name}</option>
                `;
            }
            document.getElementById('select-comuna').innerHTML = html;       
        },
        error: function(error){

        } 
    });
}