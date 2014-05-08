
var SecuenciaEjecutandose = false
var SecuenciaID = null 
var imagen = 5 
var duracion = 500
var imagenes; 
var boton;

function CompruebaVersion() { 
	if (boton=='contacto') {
		imagenes = new CreaArray( 4 ) 
	}else{
		imagenes = new CreaArray( 5 ) 
	}
	imagenes[1].src = "wp-content/themes/digital/images/Botones/"+boton+"_1.png" 
	imagenes[2].src = "wp-content/themes/digital/images/Botones/"+boton+"_2.png" 
	imagenes[3].src = "wp-content/themes/digital/images/Botones/"+boton+"_3.png" 
	imagenes[4].src = "wp-content/themes/digital/images/Botones/"+boton+"_4.png"
	if (boton!='contacto') {
		imagenes[5].src = "wp-content/themes/digital/images/Botones/"+boton+"_5.png" 	
	};
	

	if (navigator.appVersion.charAt(0) >= 3 && document.images) 
		return true 
	else 
		return false 
}

function CreaArray(n) { 
	this.length = n 
	for (var i = 1; i<=n; i++) { 
		this[i] = new Image() 
	} 
	return this 
}

function DetenerSecuencia () { 
	if( SecuenciaEjecutandose ) 
	clearTimeout(SecuenciaID) 
	SecuenciaEjecutandose = false 
	imagen = 0 
	document.getElementById(boton).src = "wp-content/themes/digital/images/Botones/"+boton+"_0.png" 
}

function MostrarSecuencia () { 
	if (CompruebaVersion()) { 
	document.getElementById(boton).src = imagenes[imagen].src 
	imagen++ 
	var num = 6
	if (boton=='contacto') {
		num=5;
	};
	if ( imagen == num ) 
		imagen = 1 
	} 
	SecuenciaID = setTimeout(" MostrarSecuencia() ", duracion) 
	SecuenciaEjecutandose = true 
}
function setBoton(botonId){
	boton = botonId
}

function IniciarSecuencia (botonId) { 
	setBoton(botonId)
	DetenerSecuencia() 
	imagen = 1 
	MostrarSecuencia() 
}