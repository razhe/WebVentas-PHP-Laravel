//Btn scroll up
window.addEventListener('scroll', function () {
	let btnUp = document.getElementById('container-btn-up');
	btnUp.classList.toggle('active-btn-up', window.scrollY > 200);
});
//Scroll up
document.getElementById('btn-up').addEventListener('click', function(){
	let currentScroll = document.documentElement.scrollTop;
	if (currentScroll > 0) {
		window.scrollTo(0,0);
	}
});

window.addEventListener('load', function(){
	new Glider(document.querySelector('.carrousel-novedades'), {
		slidesToShow: 1,
		slidesToScroll: 1,
		dots: '.indicadores-novedades',
		arrows: {
			prev: '.anterior-novedades',
			next: '.siguente-novedades'
		},
		responsive: [
			{
			  // screens greater than >= 775px
			  breakpoint: 450,
			  settings: {
				// Set to `auto` and provide item width to adjust to viewport
				slidesToShow: 2,
				slidesToScroll: 2
			  }
			},{
			  // screens greater than >= 1024px
			  breakpoint: 800,
			  settings: {
				slidesToShow: 4,
				slidesToScroll: 4
			  }
			}
		]
	});
	new Glider(document.querySelector('.carrousel-mas-vendidos'), {
		slidesToShow: 1,
		slidesToScroll: 1,
		dots: '.indicadores-mas-vendido',
		arrows: {
			prev: '.anterior-mas-vendido',
			next: '.siguente-mas-vendido'
		},
		responsive: [
			{
			  // screens greater than >= 775px
			  breakpoint: 450,
			  settings: {
				// Set to `auto` and provide item width to adjust to viewport
				slidesToShow: 2,
				slidesToScroll: 2
			  }
			},{
			  // screens greater than >= 1024px
			  breakpoint: 800,
			  settings: {
				slidesToShow: 4,
				slidesToScroll: 4
			  }
			}
		]
	});
});
