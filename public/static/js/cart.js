$(document).ready(function(){
	listarCarrito();
});
let csfr_token = document.getElementsByName('csrf-token')[0].getAttribute('content'),
    currency = document.getElementsByName('currency')[0].getAttribute('content'),
    inpt_cart = document.getElementsByClassName('inpt_cart_quant');
    removeBtnCart = document.getElementsByClassName('btn-remove-item');



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
                htmlCarrito = "",
                boxTotalCarrito = document.getElementById('box-rows-totalCarrito'),
                htmlTotalCarrito = "",
                btnCheckOut = document.getElementById('btn-go-CheckOut');
            if(data.carrito == null){
                htmlCarrito += `
                <tr>
                    <div class="cart-nocontent-available">
                        <h4>No hay nada agregado al carrito</h4> <i class="bi bi-bag-dash"></i>
                    </div>
                </tr>
                `;
                boxCarrito.innerHTML = htmlCarrito;
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
                                    <small>precio: <span>${currency+data.carrito[i].precio}</span></small><br>
                                    <button class="btn-remove-item" data-parent="${data.carrito[i].id}">remover</button>
                                </div>
                            </div>
                        </td>
                        <td><input class="inpt_cart_quant" type="number" value="${data.carrito[i].cantidad}" data-parent="${data.carrito[i].id}" min="1" max="${data.carrito[i].stock}"></td>
                        <td>${currency + data.carrito[i].subtotal}</td>
                    </tr>
                    `;
                }
                htmlTotalCarrito += `
                <tr>
                    <td>Total Neto</td>
                    <td>${currency + Math.round(data.totalCarrito[0].total_neto)}</td>
                </tr>
                <tr>
                    <td>IVA</td>
                    <td>${currency + Math.round(data.totalCarrito[0].iva)}</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>${currency + Math.round(data.totalCarrito[0].total)}</td>
                </tr>
                `;
                btnCheckOut.innerHTML = 
                `       
                        <a href="${urlCheckout}">
                            <button class="btn btn-success">Proceder al pago</button>
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

    



    

/* 
$(document).on('change','.inpt_cart_quant',function(){
    for (let i = 0; i < inpt_cart.length; i++) {
        console.log(inpt_cart[i].value);
    }
});   

inpt_cart[i].addEventListener('change', (event)=>{
    console.log('cambio el input' + inpt_cart[i]);
});
*/