const titulosUsuario = document.getElementsByClassName('title_collapse'),
      inptForm = document.getElementsByClassName('inpt-default-form');

let ultimoTituloActivo = 0;

for (let i = 0; i < titulosUsuario.length; i++) {
    titulosUsuario[i].addEventListener('click', (e)=>{
        titulosUsuario[ultimoTituloActivo].classList.remove('activo');
        titulosUsuario[i].classList.toggle('activo');
        ultimoTituloActivo = i;
    });
}


