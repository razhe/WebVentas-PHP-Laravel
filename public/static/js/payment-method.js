const radioBoleta = document.getElementById('radio_boleta'),
      radioFactura = document.getElementById('radio_factura'),
      tituloBoleta =document.getElementById('titulo-boleta'),
      tituloFactura =document.getElementById('titulo-factura');
      
radioBoleta.addEventListener('click', (event) => {
    tituloFactura.classList.remove('activo');
    tituloBoleta.classList.add('activo');
})
radioFactura.addEventListener('click', (event) => {
    tituloBoleta.classList.remove('activo');
    tituloFactura.classList.add('activo');
})