@extends('layout')
@section('CSS')
    <link rel="stylesheet" href="{{url('static/css/cart.css')}}">
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
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                        <tr>
                            <td>
                                <div class="cart-info">
                                    <img src="{{asset('static/images/default.jpg')}}" alt="">
                                    <div>
                                        <p>Nombre producto</p>
                                        <small>precio: <span>$9000</span></small><br>
                                        <a href="#">eliminar</a>
                                    </div>
                                </div>
                            </td>
                            <td><input type="number" name="" id="" value="1" min="1" max=""></td>
                            <td>$9990</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="cart-info">
                                    <img src="{{asset('static/images/default.jpg')}}" alt="">
                                    <div>
                                        <p>Nombre producto</p>
                                        <small>precio: <span>$9000</span></small><br>
                                        <a href="#">eliminar</a>
                                    </div>
                                </div>
                            </td>
                            <td><input type="number" name="" id="" value="1" min="1" max=""></td>
                            <td>$9990</td>
                        </tr>
                    </table>
                </div>
                <div class="cart-total-container">
                    <table>
                        <tr>
                            <td>Subtotal</td>
                            <td>$19010</td>
                        </tr>
                        <tr>
                            <td>IVA</td>
                            <td>$730</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>$19740</td>
                        </tr>
                    </table>
                </div>
            </section>
        </div>
    </main>
@endsection

@section('JS')
    
@endsection