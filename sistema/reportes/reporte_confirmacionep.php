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

$pdf->Cell(18, 10, '', 0);
$pdf->Cell(120, 10, 'Parroquia '.$data1['parroquia'], 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(20, 10, 'Hoy: '.fecha(), 0);
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 8, 'LISTADO DE CONFIRMACION', 0, 1, 'C');
$pdf->Ln(1);
$pdf->Cell(0, 8, 'Desde: '.$verDesde.' hasta: '.$verHasta, 0, 1, 'C');
$pdf->Ln(8);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(5, 8, '', 0);
$pdf->Cell(20, 8, 'Numero', 0);
$pdf->Cell(95, 8, 'Nombre', 0);
$pdf->Cell(20, 8, 'Partida', 0);
$pdf->Cell(15, 8, 'Folio', 0);
$pdf->Cell(20, 8, 'Fecha', 0);
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 12);
}
//CONSULTA
$consulta = mysql_query("SELECT
c.idconfirmacion,
f.nombre,
c.partida,
c.folio,
c.fecha
FROM confirmacionep as c
JOIN feligresesep as f on c.idfeligres = f.idfeligres
WHERE fecha BETWEEN '$desde' AND '$hasta' ORDER BY fecha,nombre ASC ");
$item = 0;

while($data = mysql_fetch_array($consulta)){
	$item = $item+1;
	$pdf->Cell(5, 8, '', 0);
	$pdf->Cell(20, 8, $item, 0);
	$pdf->Cell(95, 8, $data['nombre'], 0);
	$pdf->Cell(20, 8, $data['partida'], 0);
	$pdf->Cell(15, 8, $data['folio'], 0);
	$pdf->Cell(20, 8, date('d/m/Y', strtotime($data['fecha'])), 0);
	$pdf->Ln(8);
}


$pdf->Output('reporte.pdf','I');
?>