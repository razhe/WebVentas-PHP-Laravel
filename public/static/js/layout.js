//======================
//Código de la plantilla
//======================
const btnDepartamentos = document.getElementById('btn-categorias'),
	  btnCerrarMenu = document.getElementById('btn-menu-cerrar'),
	  grid = document.getElementById('grid'),
	  contenedorEnlacesNav = document.querySelector('#menu .contenedor-enlaces-nav'),
	  contenedorSubCategorias = document.querySelector('#grid .contenedor-subcategorias'),
	  esDispositivoMovil = () => window.innerWidth <= 800,
	  userBtnOptions = document.getElementById('user-opt'),
	  userListOptions = document.getElementById('drop-list'),
	  base = location.protocol+'//'+location.host;

//Scroll	  
window.addEventListener('scroll', function () {
	let seccionSuperior = document.getElementById('seccion-superior-nav');
	let menu = document.getElementById('menu');
	seccionSuperior.classList.toggle('navbar-sticky', window.scrollY > 200);
	menu.classList.toggle('navbar-sticky', window.scrollY > 200);
});
/*user*/
userBtnOptions.addEventListener('mouseover', () => {
	if(!esDispositivoMovil()){
		userListOptions.classList.add('activo');
	}
});

userListOptions.addEventListener('mouseleave', () => {
	if(!esDispositivoMovil()){
		userListOptions.classList.remove('activo');
	}
});

userBtnOptions.addEventListener('click', () => {
	if(esDispositivoMovil()){
		userListOptions.classList.toggle('activo-movil');
		userBtnOptions.classList.toggle('activo-movil');
	}
});
/*user*/

btnDepartamentos.addEventListener('mouseover', () => {
	if(!esDispositivoMovil()){
		grid.classList.add('activo');
	}
});

grid.addEventListener('mouseleave', () => {
	if(!esDispositivoMovil()){
		grid.classList.remove('activo');
	}
});
//Subcategorias escritorio
document.querySelectorAll('#menu .categorias small').forEach((elemento) => {
	elemento.addEventListener('mouseenter', (e) => {
		let subtitulo = document.getElementById('subtitulo')
		subtitulo.setAttribute('data-categoria', elemento.dataset.categoria);
		subtitulo.innerHTML = elemento.dataset.categoria;
		if(!esDispositivoMovil()){
			let subcategorias = document.getElementsByClassName('item-subcategoria');

			for (let i = 0; i < subcategorias.length; i++) {
				subcategorias[i].classList.remove('activo');
				if(subcategorias[i].dataset.categoria == e.target.dataset.categoria){
					subcategorias[i].classList.add('activo');
				}
			}
		};
	});
});

// EventListeners para dispositivo movil.
document.querySelector('#btn-menu-barras').addEventListener('click', (e) => {
	e.preventDefault();
	if(contenedorEnlacesNav.classList.contains('activo')){
		contenedorEnlacesNav.classList.remove('activo');
		document.querySelector('body').style.overflow = 'visible';
	} else {
		contenedorEnlacesNav.classList.add('activo');
		document.querySelector('body').style.overflow = 'hidden';
	}
});

// Click en boton de todos los departamentos (Para version movil).
btnDepartamentos.addEventListener('click', (e) => {
	e.preventDefault();
	grid.classList.add('activo');
	btnCerrarMenu.classList.add('activo');
});

// Boton de regresar en el menu de categorias
document.querySelector('#grid .categorias .btn-regresar').addEventListener('click', (e) => {
	e.preventDefault();
	grid.classList.remove('activo');
	btnCerrarMenu.classList.remove('activo');
});
//subcategorías movil
document.querySelectorAll('#menu .categorias small').forEach((elemento) => {
	elemento.addEventListener('click', (e) => {
		let subtitulo = document.getElementById('subtitulo')
		subtitulo.setAttribute('data-categoria', elemento.dataset.categoria);
		subtitulo.innerHTML = elemento.dataset.categoria;
		if(esDispositivoMovil()){
			contenedorSubCategorias.classList.add('activo');
			let subcategorias = document.getElementsByClassName('item-subcategoria');

			for (let i = 0; i < subcategorias.length; i++) {
				subcategorias[i].classList.remove('activo');
				if(subcategorias[i].dataset.categoria == e.target.dataset.categoria){
					subcategorias[i].classList.add('activo');
				}
			}
		}
	});
});

// Boton de regresar en el menu de categorias
document.querySelectorAll('#grid .contenedor-subcategorias .btn-regresar').forEach((boton) => {
	boton.addEventListener('click', (e) => {
		e.preventDefault();
		contenedorSubCategorias.classList.remove('activo');
	});
});

btnCerrarMenu.addEventListener('click', (e)=> {
	e.preventDefault();
	document.querySelectorAll('#menu .activo').forEach((elemento) => {
		elemento.classList.remove('activo');
	});
	document.querySelector('body').style.overflow = 'visible';
});

//loader
window.addEventListener("beforeunload",function(e){
    document.getElementById('progress-bar').classList.remove("page-loaded");
    document.getElementById('progress-bar').classList.add("page-loading");
}, false);

window.addEventListener("load",function(e){
    document.getElementById('progress-bar').classList.add("page-loaded");
});

