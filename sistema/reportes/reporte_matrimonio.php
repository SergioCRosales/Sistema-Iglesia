<?php

if(strlen($_GET['desde'])>0 and strlen($_GET['hasta'])>0){
	$desde = $_GET['desde'];
	$hasta = $_GET['hasta'];

	$verDesde = date('d/m/Y', strtotime($desde));
	$verHasta = date('d/m/Y', strtotime($hasta));
}else{
	$desde = '1111-01-01';
	$hasta = '9999-12-30';

	$verDesde = '__/__/____';
	$verHasta = '__/__/____';
}
require('../fpdf/fpdf.php');
require('conexion.php');
ini_set("default_charset", "UTF-8");
mb_internal_encoding("UTF-8");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function fecha(){
	$mes = array("","Enero",
				  "Febrero",
				  "Marzo",
				  "Abril",
				  "Mayo",
				  "Junio",
				  "Julio",
				  "Agosto",
				  "Septiembre",
				  "Octubre",
				  "Noviembre",
				  "Diciembre");
	return date('d')." de ". $mes[date('n')] . " de " . date('Y');
}
$pdf = new FPDF('P','mm', array(215.9,279.4));
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

$query1 = mysql_query("SELECT * FROM configuracion");
while ($data1 = mysql_fetch_assoc($query1)) {
$pdf->Image('../img/matrimonio.jpg' , 15 , 20, 30 , 30,'JPG');
$pdf->Cell(18, 10, '', 0);
$pdf->Cell(90, 10, 'Parroquia '.html_entity_decode($data1['parroquia']), 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(20, 10, 'Hoy: '.fecha(), 0);
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 8, 'LISTADO DE MATRIMONIO', 0, 1, 'C');
$pdf->Ln(1);
$pdf->Cell(0, 8, 'Desde: '.$verDesde.' hasta: '.$verHasta, 0, 1, 'C');
$pdf->Ln(8);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(5, 8, '', 0);
$pdf->Cell(11, 8, 'Nro.', 0);
$pdf->Cell(127, 8, 'Nombres de los esposos', 0);
$pdf->Cell(17, 8, 'Partida', 0);
$pdf->Cell(12, 8, 'Folio', 0);
$pdf->Cell(20, 8, 'Fecha', 0);
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 10);
}
//CONSULTA
$consulta = mysql_query("SELECT
m1.idmatrimonio,
f1.nombre as esposo,
f2.nombre as esposa,
m1.partida as partida,
m1.folio as folio,
m1.libro as libro,
m1.fecha as fecha
FROM matrimonio as m1
JOIN bautismo as b1 on m1.idbautismo = b1.idbautismo
JOIN feligreses as f1 on b1.idfeligres = f1.idfeligres
JOIN bautismo as b2 on m1.idbautismo2 = b2.idbautismo
JOIN feligreses as f2 on b2.idfeligres = f2.idfeligres
WHERE m1.fecha BETWEEN '$desde' AND '$hasta' ORDER BY m1.fecha,esposo ASC ");
$item = 0;

while($data = mysql_fetch_array($consulta)){
	$item = $item+1;
	$pdf->Cell(5, 8, '', 0);
	$pdf->Cell(11, 8, $item, 0);
	$pdf->Cell(127, 8, html_entity_decode($data['esposo'].'  y  '.$data['esposa']), 0);
	$pdf->Cell(17, 8, utf8_decode($data['partida']), 0);
	$pdf->Cell(12, 8, utf8_decode($data['folio']), 0);
	$pdf->Cell(20, 8, date('d/m/Y', strtotime($data['fecha'])), 0);
	$pdf->Ln(8);
}

$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 8, 'LISTADO DE MATRIMONIO (ESPOSOS DE ESTA PARROQUIA)', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Ln();

$consulta = mysql_query("SELECT
m.idmatrimonio, 
f.nombre as esposo,
f2.nombre as esposa,
m.partida,
m.folio,
m.libro,
m.fecha
FROM matrimoniocombh as m
JOIN bautismo as b on m.idbautismo = b.idbautismo
JOIN feligreses as f on b.idfeligres = f.idfeligres
JOIN feligresesep as f2 on m.idfeligres = f2.idfeligres
WHERE m.fecha BETWEEN '$desde' AND '$hasta' ORDER BY m.fecha,esposo ASC ");


while($data = mysql_fetch_array($consulta)){
	$item = $item+1;
	$pdf->Cell(5, 8, '', 0);
	$pdf->Cell(11, 8, $item, 0);
	$pdf->Cell(127, 8, html_entity_decode($data['esposo'].'  y  '.$data['esposa']), 0);
	$pdf->Cell(17, 8, utf8_decode($data['partida']), 0);
	$pdf->Cell(12, 8, utf8_decode($data['folio']), 0);
	$pdf->Cell(20, 8, date('d/m/Y', strtotime($data['fecha'])), 0);
	$pdf->Ln(8);
}

$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 8, 'LISTADO DE MATRIMONIO (ESPOSAS DE ESTA PARROQUIA)', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Ln();

$consulta = mysql_query("SELECT
m.idmatrimonio, 
f2.nombre as esposo,
f.nombre as esposa,
m.partida,
m.folio,
m.libro,
m.fecha
FROM matrimoniocombm as m
JOIN bautismo as b on m.idbautismo = b.idbautismo
JOIN feligreses as f on b.idfeligres = f.idfeligres
JOIN feligresesep as f2 on m.idfeligres = f2.idfeligres
WHERE m.fecha BETWEEN '$desde' AND '$hasta' ORDER BY m.fecha,esposo ASC ");


while($data = mysql_fetch_array($consulta)){
	$item = $item+1;
	$pdf->Cell(5, 8, '', 0);
	$pdf->Cell(11, 8, $item, 0);
	$pdf->Cell(127, 8, html_entity_decode($data['esposo'].'  y  '.$data['esposa']), 0);
	$pdf->Cell(17, 8, utf8_decode($data['partida']), 0);
	$pdf->Cell(12, 8, utf8_decode($data['folio']), 0);
	$pdf->Cell(20, 8, date('d/m/Y', strtotime($data['fecha'])), 0);
	$pdf->Ln(8);
}

$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 8, 'LISTADO DE MATRIMONIO (ESPOSOS ORIGINARIOS DE OTRAS PARROQUIA)', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Ln();

$consulta = mysql_query("SELECT
m1.idmatrimonio,
f1.nombre as esposo,
f2.nombre as esposa,
m1.partida as partida,
m1.folio as folio,
m1.libro as libro,
m1.fecha as fecha
FROM matrimonioep as m1
JOIN feligresesep as f1 on m1.idfeligres = f1.idfeligres
JOIN feligresesep as f2 on m1.idfeligres2 = f2.idfeligres
WHERE m1.fecha BETWEEN '$desde' AND '$hasta' ORDER BY m1.fecha,esposo ASC ");


while($data = mysql_fetch_array($consulta)){
	$item = $item+1;
	$pdf->Cell(5, 8, '', 0);
	$pdf->Cell(11, 8, $item, 0);
	$pdf->Cell(127, 8, html_entity_decode($data['esposo'].'  y  '.$data['esposa']), 0);
	$pdf->Cell(17, 8, utf8_decode($data['partida']), 0);
	$pdf->Cell(12, 8, utf8_decode($data['folio']), 0);
	$pdf->Cell(20, 8, date('d/m/Y', strtotime($data['fecha'])), 0);
	$pdf->Ln(8);
}



$pdf->Ln();
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 8, '     TOTAL DE REGISTROS  = '.$item, 0, 1);

$pdf->Output('reporte.pdf','I');
?>