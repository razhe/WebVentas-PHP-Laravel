const btnRegister = document.getElementById('btn-register'),
    emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;//email

if (!!btnRegister) {
    btnRegister.addEventListener('click', (e)=>{
        e.preventDefault();
        let errores = 0;
        let inputEmail = document.getElementById('email_register'),
            inputName = document.getElementById('name_register'),
            inputLast = document.getElementById('last_name_register'),
            inputPhone = document.getElementById('phone_register'),
            inputCpassword = document.getElementById('cpassword_register'),
            inputPassword = document.getElementById('password_register'),
            selectPhoneCode = document.getElementById('select_phone_register');
        //nombre    
        if (inputName.value.trim() === '' || inputName.value.trim() == null) {
            inputName.classList.remove('input-valido');
            inputName.classList.add('input-invalido');
            document.getElementById('error_name_register').innerHTML = '(*) El nombre es requerido.';
            errores++;
        } else{
            document.getElementById('error_name_register').innerHTML = '';
            inputName.classList.remove('input-invalido');
            inputName.classList.add('input-valido');
        }
        //Apellido
        if (inputLast.value.trim() === '' || inputLast.value.trim() == null) {
            inputLast.classList.remove('input-valido');
            inputLast.classList.add('input-invalido');
            document.getElementById('error_last_name_register').innerHTML = '(*) El apellido es requerido.';
            errores++;
        } else{
            document.getElementById('error_last_name_register').innerHTML = '';
            inputLast.classList.remove('input-invalido');
            inputLast.classList.add('input-valido');
        }
        //telefono
        if (inputPhone.value.trim() === '' || inputPhone.value.trim() == null) {
            inputPhone.classList.remove('input-valido');
            inputPhone.classList.add('input-invalido');
            document.getElementById('error_phone_register').innerHTML = '(*) El teléfono es requerido.';
            errores++;
        }else if (isNaN(inputPhone.value) == true || inputPhone.value < 0) {
            inputPhone.classList.remove('input-valido');
            inputPhone.classList.add('input-invalido');
            document.getElementById('error_phone_register').innerHTML = '(*) El teléfono inválido.';
            errores++;
        }
        else if (inputPhone.value.length != 8) {
                inputPhone.classList.remove('input-valido');
                inputPhone.classList.add('input-invalido');
                document.getElementById('error_phone_register').innerHTML = '(*) El teléfono no posee 8 carácteres.';
                errores++;
        }else{
            document.getElementById('error_phone_register').innerHTML = '';
            inputPhone.classList.remove('input-invalido');
            inputPhone.classList.add('input-valido');
        } 
        
        //codigo telefono
        if (selectPhoneCode.value !== '569' && selectPhoneCode.value !== '562') {
            inputPhone.classList.remove('input-valido');
            inputPhone.classList.add('input-invalido');
            document.getElementById('error_phone_register').innerHTML = '(*) Prefijo no válido.';
            errores++;
        }
        //Correo
        if (inputEmail.value.trim() === '' || inputEmail.value.trim() == null) {
            inputEmail.classList.remove('input-valido');
            inputEmail.classList.add('input-invalido');
            document.getElementById('error_email_register').innerHTML = '(*) El email es requerido.';
            errores++;
        } else if (emailRegex.test(inputEmail.value) == false){
            inputEmail.classList.remove('input-valido');
            inputEmail.classList.add('input-invalido');
            document.getElementById('error_email_register').innerHTML = '(*) Formato de email no válido.';
            errores++;
        }else{
            document.getElementById('error_email_register').innerHTML = '';
            inputEmail.classList.remove('input-invalido');
            inputEmail.classList.add('input-valido');
        }
        //Contraseña
        if (inputPassword.value.trim() === '' || inputPassword.value.trim() == null) {
            inputPassword.classList.remove('input-valido');
            inputPassword.classList.add('input-invalido');
            document.getElementById('error_password_register').innerHTML = '(*) La contraseña es requerida.';
            errores++;
        }else if(inputPassword.value.length < 8){
            inputPassword.classList.remove('input-valido');
            inputPassword.classList.add('input-invalido');

            document.getElementById('error_password_register').innerHTML = '(*) La contraseña debe tener mínimo 8 carácteres.'; 
            errores++;
        } else{
            document.getElementById('error_password_register').innerHTML = '';
            inputPassword.classList.remove('input-invalido');
            inputPassword.classList.add('input-valido');
        }
        //Confirmacion contraseña
        if (inputCpassword.value.trim() === '' || inputCpassword.value.trim() == null) {
            inputCpassword.classList.remove('input-valido');
            inputCpassword.classList.add('input-invalido');
            document.getElementById('error_cpassword_register').innerHTML = '(*) La confirmación de la contraseña es requerida.';
            errores++;
        }else if(inputCpassword.value.length < 8){
            inputCpassword.classList.remove('input-valido');
            inputCpassword.classList.add('input-invalido');
            errores++;
        }else if (inputCpassword.value !== inputPassword.value){
            inputCpassword.classList.remove('input-valido');
            inputCpassword.classList.add('input-invalido');

            inputPassword.classList.remove('input-valido');
            inputPassword.classList.add('input-invalido');

            document.getElementById('error_cpassword_register').innerHTML = '(*) Las contraseñas no coinciden.';
            errores++;
        } else{
            document.getElementById('error_cpassword_register').innerHTML = '';
            inputCpassword.classList.remove('input-invalido');
            inputCpassword.classList.add('input-valido');
        }

        if(errores == 0){
            document.getElementById('register-form').submit();
        }
    });
}