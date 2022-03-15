$(document).ready(pagination(1));

function reportePDF(){
	var desde = $('#bd-desde').val();
	var hasta = $('#bd-hasta').val();
	window.open('reportes/reporte_bautismo.php?desde='+desde+'&hasta='+hasta);
}

function reportePDFcomunion(){
	var desde = $('#bd-desde').val();
	var hasta = $('#bd-hasta').val();
	window.open('reportes/reporte_comunion.php?desde='+desde+'&hasta='+hasta);
}

function reportePDFcomunionep(){
	var desde = $('#bd-desde').val();
	var hasta = $('#bd-hasta').val();
	window.open('reportes/reporte_comunionep.php?desde='+desde+'&hasta='+hasta);
}

function reportePDFconfirmacion(){
	var desde = $('#bd-desde').val();
	var hasta = $('#bd-hasta').val();
	window.open('reportes/reporte_confirmacion.php?desde='+desde+'&hasta='+hasta);
}

function reportePDFconfirmacionep(){
	var desde = $('#bd-desde').val();
	var hasta = $('#bd-hasta').val();
	window.open('reportes/reporte_confirmacionep.php?desde='+desde+'&hasta='+hasta);
}

function reportePDFmatrimonio(){
	var desde = $('#bd-desde').val();
	var hasta = $('#bd-hasta').val();
	window.open('reportes/reporte_matrimonio.php?desde='+desde+'&hasta='+hasta);
}
