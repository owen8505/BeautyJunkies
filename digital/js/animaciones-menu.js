
var SecuenciaEjecutandose = false
var SecuenciaID = null 
var imagen = 4 
var duracion = 250
var imagenes; 
var boton;

function CompruebaVersion() { 

	imagenes = new CreaArray( 4 ) 
	imagenes[1].src = "wp-content/themes/digital/images/Botones/"+boton+"_1.png" 
	imagenes[2].src = "wp-content/themes/digital/images/Botones/"+boton+"_2.png" 
	imagenes[3].src = "wp-content/themes/digital/images/Botones/"+boton+"_3.png" 
	imagenes[4].src = "wp-content/themes/digital/images/Botones/"+boton+"_4.png"
	

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
		document.getElementById(boton+'_txt').innerHTML = '';
	clearTimeout(SecuenciaID) 
	SecuenciaEjecutandose = false 
	imagen = 0 
	document.getElementById(boton).src = "wp-content/themes/digital/images/Botones/"+boton+"_0.png" 
}

function MostrarSecuencia () { 
	if (CompruebaVersion()) { 
	document.getElementById(boton).src = imagenes[imagen].src 
	imagen++ 
	var num = 5
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
	mayus = boton.substring(0, 1);
	document.getElementById(boton+'_txt').innerHTML = mayus.toUpperCase()+boton.substring(1);
	DetenerSecuencia() 
	imagen = 1 
	MostrarSecuencia() 
}