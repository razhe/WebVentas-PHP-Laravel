const btnPerfilPrincipal = document.getElementById('pefil-principal'),
      btnCambiarContraseña = document.getElementById('pefil-contraseña');

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

