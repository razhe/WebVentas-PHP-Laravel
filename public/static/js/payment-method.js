const radioBoleta = document.getElementById('radio_boleta'),
      radioFactura = document.getElementById('radio_factura'),
      tituloBoleta =document.getElementById('titulo-boleta'),
      tituloFactura =document.getElementById('titulo-factura'),
      btnGoSummPay = document.getElementById('btn-go-summary-payment');

//Toastr options
toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
//Validar rut
var Fn = {
	// Valida el rut con su cadena completa "XXXXXXXX-X"
	validaRut : function (rutCompleto) {
		if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( rutCompleto ))
			return false;
		var tmp 	= rutCompleto.split('-');
		var digv	= tmp[1]; 
		var rut 	= tmp[0];
		if ( digv == 'K' ) digv = 'k' ;
		return (Fn.dv(rut) == digv );
	},
	dv : function(T){
		var M=0,S=1;
		for(;T;T=Math.floor(T/10))
			S=(S+T%10*(9-M++%6))%11;
		return S?S-1:'k';
	}
}

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
    //let radios = document.getElementsByName('payment-method');
    let radio_webpay = document.getElementById('radio_webpay');
    let radio_trasnferencia = document.getElementById('radio_trasnferencia')
    let selectedPayment = '';

    if (!!radio_webpay && radio_webpay.checked) {
        selectedPayment = radio_webpay.value;
    }else if(!!radio_trasnferencia && radio_trasnferencia.checked){
        selectedPayment = radio_trasnferencia.value;
    }

    if (selectedPayment != '') {
        if (radioBoleta.checked) {
            let rut = document.getElementById('rut-boleta');
            let errores = 0;
            if (rut.value.trim() === '' || rut.value.trim() == null) {
                rut.classList.remove('input-valido');
                rut.classList.add('input-invalido');
                document.getElementById('error_rut_boleta').innerHTML = '(*) El rut es requerido';
                errores++;
            }else if(Fn.validaRut(rut.value) == false){
                rut.classList.remove('input-valido');
                rut.classList.add('input-invalido');
                document.getElementById('error_rut_boleta').innerHTML = '(*) El rut ingresado no es válido';
                errores++;
            }
            else{
                rut.classList.remove('input-invalido');
                rut.classList.add('input-valido');
                document.getElementById('error_rut_boleta').innerHTML = '';
            }
            
            if (selectedPayment !== 'WebPay' && selectedPayment !== 'Transferencia-bancaria') {
                toastr["error"]("Medio de pago no aceptado.", "Oops... ha ocurrido algo inesperado.");
                errores++;
            }
            if (errores == 0) {
                $.ajax({
                    url: '../checkout/save-payment-method',
                    method: 'POST',
                    data:{
                        tipo_documento: 'boleta',
                        medio_pago: selectedPayment,
                        rut: rut.value,
                    },
                    success: function(data) { 
                        //console.log(data);
                        window.location.replace(data);
                    } 
                });
            }
        }
        if (radioFactura.checked) {
            let errores = 0;
            let razonSocial = document.getElementById('razon-social'),
                rut = document.getElementById('rut-factura'),
                giro = document.getElementById('giro'),
                ciudad = document.getElementById('ciudad'),
                comuna = document.getElementById('comuna'),
                direccion = document.getElementById('direccion'),
                telefono = document.getElementById('telefono');

            if (razonSocial.value.trim() === '' || razonSocial.value.trim() == null) {
                razonSocial.classList.remove('input-valido');
                razonSocial.classList.add('input-invalido');
                document.getElementById('error_razon_factura').innerHTML = '(*) La razón social es requerida';
                errores++;
            }else{
                razonSocial.classList.remove('input-invalido');
                razonSocial.classList.add('input-valido');
                document.getElementById('error_razon_factura').innerHTML = '';
            }

            if (rut.value.trim() === '' || rut.value.trim() == null) {
                rut.classList.remove('input-valido');
                rut.classList.add('input-invalido');
                document.getElementById('error_rut_factura').innerHTML = '(*) El rut es requerido';
                errores++;
            }else if(Fn.validaRut(rut.value) == false){
                rut.classList.remove('input-valido');
                rut.classList.add('input-invalido');
                document.getElementById('error_rut_factura').innerHTML = '(*) El rut ingresado no es válido';
                errores++;
            }
            else{
                rut.classList.remove('input-invalido');
                rut.classList.add('input-valido');
                document.getElementById('error_rut_factura').innerHTML = '';
            }

            if (giro.value.trim() === '' || giro.value.trim() == null) {
                giro.classList.remove('input-valido');
                giro.classList.add('input-invalido');
                document.getElementById('error_giro_factura').innerHTML = '(*) El giro es requerido';
                errores++;
            }else{
                giro.classList.remove('input-invalido');
                giro.classList.add('input-valido');
                document.getElementById('error_giro_factura').innerHTML = '';
            }
            if (ciudad.value.trim() === '' || ciudad.value.trim() == null) {
                ciudad.classList.remove('input-valido');
                ciudad.classList.add('input-invalido');
                document.getElementById('error_ciudad_factura').innerHTML = '(*) La ciudad es requerida';
                errores++;
            }else{
                ciudad.classList.remove('input-invalido');
                ciudad.classList.add('input-valido');
                document.getElementById('error_ciudad_factura').innerHTML = '';
            }
            if (comuna.value.trim() === '' || comuna.value.trim() == null) {
                comuna.classList.remove('input-valido');
                comuna.classList.add('input-invalido');
                document.getElementById('error_comuna_factura').innerHTML = '(*) La comuna es requerida';
                errores++;
            }else{
                comuna.classList.remove('input-invalido');
                comuna.classList.add('input-valido');
                document.getElementById('error_comuna_factura').innerHTML = '';
            }
            if (direccion.value.trim() === '' || direccion.value.trim() == null) {
                direccion.classList.remove('input-valido');
                direccion.classList.add('input-invalido');
                document.getElementById('error_direccion_factura').innerHTML = '(*) La dirección es requerida';
                errores++;
            }else{
                direccion.classList.remove('input-invalido');
                direccion.classList.add('input-valido');
                document.getElementById('error_direccion_factura').innerHTML = '';
            }
            if (telefono.value.trim() === '' || telefono.value.trim() == null) {
                telefono.classList.remove('input-valido');
                telefono.classList.add('input-invalido');
                document.getElementById('error_telefono_factura').innerHTML = '(*) El teléfono es requerido';
                errores++;
            }else{
                direccion.classList.remove('input-invalido');
                direccion.classList.add('input-valido');
                document.getElementById('error_telefono_factura').innerHTML = '';
            }

            if (errores == 0) {
                $.ajax({
                    url: '../checkout/save-payment-method',
                    method: 'POST',
                    data:{
                        tipo_documento: 'factura',
                        medio_pago: selectedPayment,
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
        toastr["warning"]("Debes seleccionar un método de pago primero.", "Atención");
    }
});