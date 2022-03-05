const titulosUsuario = document.getElementsByClassName('title_collapse'),
      radioBoleta = document.getElementById('radio_boleta'),
      radioFactura = document.getElementById('radio_factura'),
      tituloBoleta =document.getElementById('titulo-boleta'),
      tituloFactura =document.getElementById('titulo-factura');

for (let i = 0; i < titulosUsuario.length; i++) {
    titulosUsuario[i].classList.remove('activo');
    titulosUsuario[i].addEventListener('click', (e)=>{
        titulosUsuario[i].classList.toggle('activo');
    });
}

radioBoleta.addEventListener('click', (event) => {
    tituloFactura.classList.remove('activo');
    tituloBoleta.classList.add('activo');
})
radioFactura.addEventListener('click', (event) => {
    tituloBoleta.classList.remove('activo');
    tituloFactura.classList.add('activo');
})