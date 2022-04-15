const btnChangePass = document.getElementById('btn-change-password'),
    emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;//email

if (!!btnChangePass) {
    btnChangePass.addEventListener('click', (e)=>{
        e.preventDefault();
        let inputPass = document.getElementById('password_change'),
            inputCpass = document.getElementById('cpassword_change');

        let errores = 0;

        //Contraseña
        if (inputPass.value.trim() === '' || inputPass.value.trim() == null) {
            inputPass.classList.remove('input-valido');
            inputPass.classList.add('input-invalido');
            document.getElementById('error_password_changepass').innerHTML = '(*) La contraseña es requerida.';
            errores++;
        }else if(inputPass.value.length < 8){
            inputPass.classList.remove('input-valido');
            inputPass.classList.add('input-invalido');

            document.getElementById('error_password_changepass').innerHTML = '(*) La contraseña debe tener mínimo 8 carácteres.'; 
            errores++;
        } else{
            document.getElementById('error_password_changepass').innerHTML = '';
            inputPass.classList.remove('input-invalido');
            inputPass.classList.add('input-valido');
        }
        //Confirmacion contraseña
        if (inputCpass.value.trim() === '' || inputCpass.value.trim() == null) {
            inputCpass.classList.remove('input-valido');
            inputCpass.classList.add('input-invalido');
            document.getElementById('error_cpassword_changepass').innerHTML = '(*) La confirmación de la contraseña es requerida.';
            errores++;
        }else if(inputCpass.value.length < 8){
            inputCpass.classList.remove('input-valido');
            inputCpass.classList.add('input-invalido');
            errores++;
        }else if (inputCpass.value !== inputPass.value){
            inputCpass.classList.remove('input-valido');
            inputCpass.classList.add('input-invalido');

            inputPass.classList.remove('input-valido');
            inputPass.classList.add('input-invalido');

            document.getElementById('error_cpassword_changepass').innerHTML = '(*) Las contraseñas no coinciden.';
            errores++;
        } else{
            document.getElementById('error_cpassword_changepass').innerHTML = '';
            inputCpass.classList.remove('input-invalido');
            inputCpass.classList.add('input-valido');
        }

        if(errores == 0){
            document.getElementById('change-password-form').submit();
        }
    });
    
}