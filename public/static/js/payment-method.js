const radioBoleta = document.getElementById('radio_boleta'),
      radioFactura = document.getElementById('radio_factura'),
      tituloBoleta =document.getElementById('titulo-boleta'),
      tituloFactura =document.getElementById('titulo-factura'),
      btnGoSummPay = document.getElementById('btn-go-summary-payment');

radioBoleta.addEventListener('click', (event) => {
    tituloFactura.classList.remove('activo');
    tituloBoleta.classList.add('activo');
})
radioFactura.addEventListener('click', (event) => {
    tituloBoleta.classList.remove('activo');
    tituloFactura.classList.add('activo');
})

let csfr_token = document.getElementsByName('csrf-token')[0].getAttribute('content');
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': csfr_token
	}
});

btnGoSummPay.addEventListener('click', function(){
    let radios = document.getElementsByName('payment-method');
    let selectedPayment = '';
    for (let radio of radios)
    {
        if (radio.checked) {
            selectedPayment = radio.value;
        }
    }
    if (selectedPayment != '') {
        if (radioBoleta.checked) {
            let rut = document.getElementById('rut-boleta');
            let contadorErrores = 0;
            if (selectedPayment.value == "") {
                contadorErrores++;
            }
            if (rut.value.trim() ==  "") {
                contadorErrores++;
            }
            if (contadorErrores == 0) {
                $.ajax({
                    url: '../checkout/save-payment-method',
                    method: 'POST',
                    data:{
                        tipo_documento: 'boleta',
                        tipo_pago: selectedPayment,
                        rut: rut.value,
                    },
                    success: function(data) { 
                        window.location.replace(data);
                    } 
                });
            }
        }
        if (radioFactura.checked) {
            let contadorErrores = 0;
            let razonSocial = document.getElementById('razon-social');
            let rut = document.getElementById('rut-factura');
            let giro = document.getElementById('giro');
            let ciudad = document.getElementById('ciudad');
            let comuna = document.getElementById('comuna');
            let direccion = document.getElementById('direccion');
            let telefono = document.getElementById('telefono');
    
            if (selectedPayment.value == "") {
                contadorErrores++;
            }
            if (razonSocial.value.trim() == "") {
                contadorErrores++;
            }
            if (rut.value.trim() ==  "") {
                contadorErrores++;
            }
            if (giro.value.trim() ==  "") {
                contadorErrores++;
            }
            if (ciudad.value.trim() ==  "") {
                contadorErrores++;
            }
            if (comuna.value.trim() ==  "") {
                contadorErrores++;
            }
            if (direccion.value.trim() ==  "") {
                contadorErrores++;
            }
            if (telefono.value.trim() ==  "") {
                contadorErrores++;
            }
            if (contadorErrores == 0) {
                $.ajax({
                    url: '../checkout/save-payment-method',
                    method: 'POST',
                    data:{
                        tipo_documento: 'factura',
                        tipo_pago: selectedPayment,
                        razon_social: razonSocial.value,
                        rut: rut.value,
                        giro: giro.value,
                        ciudad: ciudad.value,
                        comuna: comuna.value,
                        direccion: direccion.value,
                        telefono: telefono.value,
                    },
                    success: function(data) {
                        window.location.replace(data);
                    }
                });
            }
        }
    }else{
        //do something
    }
});