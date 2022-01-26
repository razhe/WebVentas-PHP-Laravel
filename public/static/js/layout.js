const btnCategorias = document.getElementById('btn-categorias'),
    btnCerrarMenu = document.getElementById('btn-close-nav'),
    contenedorEnlaces = document.querySelector('#menu #contenedor-enlaces-nav'),
    contenedorSubcategorias = document.querySelector('#grid .subcategorias-box'),
    grid = document.getElementById('grid'),
    esDispositivoMovil = () => window.innerWidth <= 825;

btnCategorias.addEventListener('mouseover', (e)=>{
    if(!esDispositivoMovil()){
        grid.classList.add('activo')
    }
});

grid.addEventListener('mouseleave', (e)=>{
    if(!esDispositivoMovil()){
        grid.classList.remove('activo')
    }
});

//Obtener el data set de categorias
document.querySelectorAll('#menu .categorias-box a').forEach((elemento)=>{
    elemento.addEventListener('mouseenter', (e) =>{
        //subcategorias
        if(!esDispositivoMovil()){
            document.querySelectorAll('#menu .subcategoria').forEach((categoria)=>{
                categoria.classList.remove('activo')
                if(categoria.dataset.categoria == e.target.dataset.categoria){
                    categoria.classList.add('activo');
                }
            });
        };
    });
});
//Responsividad dispositivos moviles
document.querySelector('#btn-barras-nav').addEventListener('click', (e)=>{
    e.preventDefault();//Prevenir que cambie la ruta porque es un enlace
    contenedorEnlaces.classList.toggle('activo');
    if(contenedorEnlaces.classList.contains('activo')){
        document.querySelector('body').style.overflow = 'hidden';
    }else{
        document.querySelector('body').style.overflow = 'visible';
    }
});

document.querySelector('#btn-categorias').addEventListener('click', (e)=>{
    e.preventDefault();//Prevenir que cambie la ruta porque es un enlace
    let grid = document.querySelector('#menu #grid');
    grid.classList.toggle('activo');
    btnCerrarMenu.classList.add('activo');
});

document.querySelector('#menu .btn-regresar').addEventListener('click', (e)=>{
    e.preventDefault();
    grid.classList.remove('activo');
    btnCerrarMenu.classList.remove('activo');
});

document.querySelectorAll('#menu .categorias-box a').forEach((elemento)=>{
    elemento.addEventListener('click', (e) =>{
        contenedorSubcategorias.classList.add('activo');
        //subcategorias
        if(esDispositivoMovil()){
            document.querySelectorAll('#menu .subcategoria').forEach((categoria)=>{
                categoria.classList.remove('activo')
                if(categoria.dataset.categoria == e.target.dataset.categoria){
                    categoria.classList.add('activo');
                }
            });
        };
    });
});

document.querySelectorAll('#menu .subcategorias-box .btn-regresar').forEach((boton) => {
    boton.addEventListener('click', (e)=>{
        e.preventDefault();
        contenedorSubcategorias.classList.remove('activo');
    });
});
    




btnCerrarMenu.addEventListener('click', (e)=>{
    e.preventDefault();
    document.querySelectorAll('#menu .activo').forEach((elemento)=>{
        elemento.classList.remove('activo');
    });
    document.querySelector('body').style.overflow = 'visible';
});
