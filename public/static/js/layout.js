//======================
//Código del sitio
//======================
let base = location.protocol+'//'+location.host;
    route = document.getElementsByName('routeName')[0].getAttribute('content');

document.addEventListener('DOMContentLoaded', function(){

});
//======================
//Código de la plantilla
//======================
const btnDepartamentos = document.getElementById('btn-categorias'),
	  btnCerrarMenu = document.getElementById('btn-menu-cerrar'),
	  grid = document.getElementById('grid'),
	  contenedorEnlacesNav = document.querySelector('#menu .contenedor-enlaces-nav'),
	  contenedorSubCategorias = document.querySelector('#grid .contenedor-subcategorias'),
	  esDispositivoMovil = () => window.innerWidth <= 800;

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
document.querySelectorAll('#menu .categorias a').forEach((elemento) => {
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
document.querySelectorAll('#menu .categorias a').forEach((elemento) => {
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
