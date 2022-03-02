const btnfiltros = document.getElementById('mostrar-filtros'),
      seccionIzquierda = document.getElementById('seccion-izquierda'),
      tituloAcordeon = document.getElementsByClassName('titulo-secciones-filtro');

btnfiltros.addEventListener('click', (event)=>{
    seccionIzquierda.classList.toggle('activo');
});
for (let i = 0; i < tituloAcordeon.length; i++) {
    tituloAcordeon[i].addEventListener('click', function() {
       this.classList.toggle('activo'); 
    });
}

//Filtros

//Ordenar por
