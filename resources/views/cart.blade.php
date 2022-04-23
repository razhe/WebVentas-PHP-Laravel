@extends('layout')
@section('CSS')
    <link rel="stylesheet" href="{{url('static/css/cart.css?v='.time())}}">
@endsection

@section('title', 'Carrito')

@section('content')
    <main class="main-cart">
        <div class="container-cart">
            <section class="breadcrumbs">
                <div class="box-breadcrumbs">
                    <ul class="breadcrumbs">
                        <li class="breadcrumbs__item"><a href="{{url('/')}}" class="bradcrumbs--link">Home</a></li>
                        <li class="breadcrumbs__item"><a href="{{url('')}}" class="bradcrumbs--link">Detalles del producto</a></li>
                        <li class="breadcrumbs__item"><span class="bradcrumbs--link--active">Carrito</span></li>
                    </ul>
                </div>
            </section>
            <!--Carrito-->
            <section class="cart-section">
                <div class="cart-container-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                            </tr> 
                        </thead>
                        <tbody id="box-rows-carrito">
                            <!--Encode js...-->
                        </tbody>    
                    </table>
                    <div class="" id="container-no-cart-content">
                        
                    </div>
                </div>
                <div class="cart-total-container" id="cart-total-container">
                    <table>
                        <tbody id="box-rows-totalCarrito">
                            
                        </tbody>
                    </table>
                </div>
                <div class="btn-go-CheckOut" id="btn-go-CheckOut">

                </div>
            </section>
        </div>
    </main>
@endsection

@section('JS')
    <script src="{{url('static/js/cart.js')}}"></script>
    <script>var urlCheckout = "{{url('/checkout/customer-information')}}";</script>
@endsection
