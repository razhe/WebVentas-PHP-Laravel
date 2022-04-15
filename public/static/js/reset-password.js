const btnReset = document.getElementById('btn-reset-password'),
    emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;//email

if (!!btnReset) {
    btnReset.addEventListener('click', (e)=>{
        e.preventDefault();
        let inputCodigo = document.getElementById('codigo');

        let errores = 0;
        
        //telefono
        if (inputCodigo.value.trim() === '' || inputCodigo.value.trim() == null) {
            inputCodigo.classList.remove('input-valido');
            inputCodigo.classList.add('input-invalido');
            document.getElementById('error_codigo_reset').innerHTML = '(*) El código es requerido.';
            errores++;
        }else if (isNaN(inputCodigo.value) == true || inputCodigo.value < 0) {
            inputCodigo.classList.remove('input-valido');
            inputCodigo.classList.add('input-invalido');
            document.getElementById('error_codigo_reset').innerHTML = '(*) El código inválido.';
            errores++;
        }else{
            document.getElementById('error_codigo_reset').innerHTML = '';
            inputCodigo.classList.remove('input-invalido');
            inputCodigo.classList.add('input-valido');
        } 

        if (errores == 0) {
            document.getElementById('reset-password-form').submit();
        }
    })
}