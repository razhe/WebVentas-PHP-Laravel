const btnLogin = document.getElementById('btn-login'),
    emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;//email

if (!!btnLogin) {
    btnLogin.addEventListener('click', (e)=>{
        e.preventDefault();
        let errores = 0;
        let inputEmail = document.getElementById('email_login'),
            inputPassword = document.getElementById('password_login');

        if (inputEmail.value.trim() === '' || inputEmail.value.trim() == null) {
            inputEmail.classList.remove('input-valido');
            inputEmail.classList.add('input-invalido');
            document.getElementById('error_email_login').innerHTML = '(*) El email es requerido.';
            errores++;
        } else if (emailRegex.test(inputEmail.value) == false){
            inputEmail.classList.remove('input-valido');
            inputEmail.classList.add('input-invalido');
            document.getElementById('error_email_login').innerHTML = '(*) Formato de email no válido.';
            errores++;
        }else{
            document.getElementById('error_email_login').innerHTML = '';
            inputEmail.classList.remove('input-invalido');
            inputEmail.classList.add('input-valido');
        }

        if (inputPassword.value.trim() === '' || inputPassword.value.trim() == null) {
            inputPassword.classList.remove('input-valido');
            inputPassword.classList.add('input-invalido');
            document.getElementById('error_password_login').innerHTML = '(*) La contraseña es requerida.';
            errores++;
        } else{
            document.getElementById('error_password_login').innerHTML = '';
            inputPassword.classList.remove('input-invalido');
            inputPassword.classList.add('input-valido');
        }

        if(errores == 0){
            document.getElementById('login-form').submit();
        }
    });
}