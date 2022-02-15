<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap");
    *{
        font-family: "Inter", sans-serif;
    }
    .correo-main{
        display: flex;
        align-items: center;
    }
</style>
<body style="box-sizing: border-box; margin: 0; padding: 0; background-color: #f6f6f6;">
    <main class="correo-main">
        <div class="contenedor-correo" style="background-color: #fff; width: 60%; max-width: 680px; margin: 30px auto;">
            <div class="correo-head" style="">
                <img src="{{asset('static/images/encabezado.png')}}" alt="" srcset="" style="width: 100%;">
            </div>
            <div class="correo-contenido" style="padding: 20px;">
                @yield('content')
            </div>
            <div class="correo-footer" style="padding: 0px 20px 20px 20px; text-align: center">
                <div style="background-color: rgba(0, 0, 0, .2); height: 1px; width: 95%; margin: 0px auto;"></div>
                <p style="color: rgba(0, 0, 0, .4); font-size: .8rem;">Equipo de soporte Empresa</p>
                <p style="color: rgba(0, 0, 0, .4); font-size: .8rem;">contacto@gmail.com</p>
            </div>
        </div>
    </main>
</body>
</html>