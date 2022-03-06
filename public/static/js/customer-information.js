$(document).ready(function(){
    //obtener_region();//provisional, descomentar en caso de actualizar envios
    if (!!document.getElementById("select-comuna")) {
        traerComunasRegMet();//provisional, eliminar en caso de actualizar envios
    }
});

const btnGoPaymentGuest = document.getElementById('btn-go-payment-guest'),
      btnGoPaymentUser = document.getElementById('btn-go-payment-user');

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
if (!!btnGoPaymentGuest) {//devuelve false si no esta, true si está
    btnGoPaymentGuest.addEventListener('click', function(){
        document.getElementById('form-save-guest').submit();
    });
}

if (!!btnGoPaymentUser) {
    btnGoPaymentUser.addEventListener('click',function(){
        document.getElementById('form-save-user').submit();
    })
}
