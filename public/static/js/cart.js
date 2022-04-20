$(document).ready(function(){
	listarCarrito();
});
let csfr_token = document.getElementsByName('csrf-token')[0].getAttribute('content'),
    currency = document.getElementsByName('currency')[0].getAttribute('content'),
    inpt_cart = document.getElementsByClassName('inpt_cart_quant');
    removeBtnCart = document.getElementsByClassName('btn-remove-item');

function number_format_js(number, decimals, dec_point, thousands_point) {
    if (!decimals) {
        var len = number.toString().split('.').length;
        decimals = len > 1 ? len : 0;
    }

    if (!dec_point) {
        dec_point = '.';
    }

    if (!thousands_point) {
        thousands_point = ',';
    }

    number = parseFloat(number).toFixed(decimals);

    number = number.replace(".", dec_point);

    var splitNum = number.split(dec_point);
    splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
    number = splitNum.join(dec_point);

    return number;
}


$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': csfr_token
	}
});
function listarCarrito() {
    $.ajax({
        url:'cart/list',
        method:'GET',
        data:{},
        success:function(data) {
            let boxCarrito = document.getElementById('box-rows-carrito'),
                boxNoContent = document.getElementById('container-no-cart-content'),
                htmlCarrito = "",
                boxTotalCarrito = document.getElementById('box-rows-totalCarrito'),
                htmlTotalCarrito = "",
                btnCheckOut = document.getElementById('btn-go-CheckOut');
            if(data.carrito == null || data.carrito.length == 0){
                htmlCarrito += `
                
                    <div class="cart-nocontent-available">
                        <h4>No hay nada agregado al carrito</h4> <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                
                `;
                boxNoContent.innerHTML = htmlCarrito;
            }
            else{
                for (let i = 0; i < data.carrito.length; i++) {
                    htmlCarrito += `
                    <tr>
                        <td>
                            <div class="cart-info">
                                <img src="${data.carrito[i].imagen}" alt="">
                                <div>
                                    <p>${data.carrito[i].nombre}</p>
                                    <small>precio: <span>${currency + number_format_js(data.carrito[i].precio,0,'','.')}</span></small><br>
                                    <button class="btn-remove-item" data-parent="${data.carrito[i].id}">remover</button>
                                </div>
                            </div>
                        </td>
                        <td><input class="inpt_cart_quant" type="number" value="${data.carrito[i].cantidad}" data-parent="${data.carrito[i].id}" min="1" max="${data.carrito[i].stock}"></td>
                        <td>${currency + number_format_js(data.carrito[i].subtotal,0,'','.')}</td>
                    </tr>
                    `;
                }
                htmlTotalCarrito += `
                <tr>
                    <td>Total Neto</td>
                    <td>${currency + number_format_js(data.totalCarrito[0].total_neto,0,'','.')}</td>
                </tr>
                <tr>
                    <td>IVA</td>
                    <td>${currency + number_format_js(data.totalCarrito[0].iva,0,'','.')}</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>${currency + number_format_js(data.totalCarrito[0].total,0,'','.')}</td>
                </tr>
                `;
                btnCheckOut.innerHTML = 
                `       
                        <a href="${urlCheckout}">
                            <button class="btn-default-yellow">Proceder al pago <i class="fa-solid fa-right-long"></i></button>
                        </a>
                `;
                boxCarrito.innerHTML = htmlCarrito;
                boxTotalCarrito.innerHTML = htmlTotalCarrito;
            }
        },
        error:function(error){

        }
    });
}
$(document).ajaxSuccess(function() {
    for (let i = 0; i < inpt_cart.length; i++) {
        inpt_cart[i].addEventListener('change', (event)=>{
            let cantidad = inpt_cart[i].value;
            let code = inpt_cart[i].dataset.parent;
            $.ajax({
                url:'cart/update?cantidad='+ cantidad + '&codigo=' + code,
                method:'GET',
                data:{},
                success:function(data){
                    listarCarrito();
                },
                error:function(error){
                    console.error(error);
                }
            });
            
        });
    }
    //remove
    for (let i = 0; i < removeBtnCart.length; i++) {
        removeBtnCart[i].addEventListener('click', (event)=>{
            let code = removeBtnCart[i].dataset.parent;
            $.ajax({
                url:'cart/remove?&codigo=' + code,
                method:'GET',
                data:{},
                success:function(data){
                    listarCarrito();
                    location.reload();
                },
                error:function(error){
                    console.error(error);
                }
            });
            
        });
    }
});

