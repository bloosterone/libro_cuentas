




let indice = 1;
muestraSlides(indice);


function avanzaSlide(n){
	muestraSlides(indice+=n);
}
function posicionSlide(n){
	muestraSlides(indice=n);
}

function muestraSlides(n){
 let i;
 let slides = document.getElementsByClassName('miSlider');
 let barras = document.getElementsByClassName('barra');
 if (n > slides.length) {
 	indice=1;
 }
 if (n<1) {
 	indice = slides.length;
 }
 for (i = 0; i < slides.length; i++) {
 	slides[i].style.display = 'none';
 }
 for (i = 0; i < barras.length; i++) {
 	barras[i].className = barras[i].className.replace(" active","");
 }

 slides[indice-1].style.display = 'block';
 barras[indice-1].className +=' active';
}



$(document).ready(main);

var contador = 1;

function main(){
	$('#menu').on("click",function(){
		// $('nav').toggle(); 

		if(contador == 1){
			$('.contenedor-navbar').animate({
				top: '30',
			});
			contador = 0;
			console.log(contador);
		} else {
			contador = 1;
			$('.contenedor-navbar').animate({
				top: '-120%'
			});
			console.log(contador);
		}

	});

};
