$(document).ready(function(){
    //obtener_region();//provisional, descomentar en caso de actualizar envios
    traerComunasRegMet();//provisional, eliminar en caso de actualizar envios
});
const btnPerfilPrincipal = document.getElementById('pefil-principal'),
    btnCambiarContraseña = document.getElementById('pefil-contraseña'),
    btnPerfilDirecciones = document.getElementById('pefil-direcciones'),
    boxDireccionesAgregar = document.getElementById('box-direcciones-agregar'),
    boxDireccionesListar = document.getElementById('box-direcciones-listar'),
    tituloDirecciones = document.getElementsByClassName('titulo-item-direccion'),
    btnAgregarDireccion = document.getElementById('btn-agregar-direccion'),
    btnVolverListar = document.getElementById('volver-listar-direcciones');

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

let cajasContenido = document.getElementsByClassName('box-contenido');

btnPerfilPrincipal.addEventListener('click', function(){
    let boxPrincipal = document.getElementById('box-perfil-principal');
    for (let i = 0; i < cajasContenido.length; i++) {
        cajasContenido[i].classList.remove('activo');
    }
    boxPrincipal.classList.add('activo');
});
btnCambiarContraseña.addEventListener('click', function(){
    let boxPrincipal = document.getElementById('box-contraseña');
    for (let i = 0; i < cajasContenido.length; i++) {
        cajasContenido[i].classList.remove('activo');
    }
    boxPrincipal.classList.add('activo');
});

btnPerfilDirecciones.addEventListener('click', function(){
    let boxPrincipal = document.getElementById('box-direcciones-listar');
    for (let i = 0; i < cajasContenido.length; i++) {
        cajasContenido[i].classList.remove('activo');
    }
    boxPrincipal.classList.add('activo');
});

let csfr_token = document.getElementsByName('csrf-token')[0].getAttribute('content');
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': csfr_token
	}
});

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
            html += `<option selected disabled>Seleccione:</option>`;
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