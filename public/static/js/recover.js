const btnRecover = document.getElementById('btn-recover-password'),
    emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;//email

if (!!btnRecover) {
    btnRecover.addEventListener('click', (e)=>{
        e.preventDefault();
        let inputEmail = document.getElementById('email');

        let errores = 0;
        //Correo
        if (inputEmail.value.trim() === '' || inputEmail.value.trim() == null) {
            inputEmail.classList.remove('input-valido');
            inputEmail.classList.add('input-invalido');
            document.getElementById('error_email_recoverpass').innerHTML = '(*) El email es requerido.';
            errores++;
        } else if (emailRegex.test(inputEmail.value) == false){
            inputEmail.classList.remove('input-valido');
            inputEmail.classList.add('input-invalido');
            document.getElementById('error_email_recoverpass').innerHTML = '(*) Formato de email no válido.';
            errores++;
        }else{
            document.getElementById('error_email_recoverpass').innerHTML = '';
            inputEmail.classList.remove('input-invalido');
            inputEmail.classList.add('input-valido');
        }
        
        if(errores == 0){
            document.getElementById('recover-password-form').submit();
        }
    })
}