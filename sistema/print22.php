<?php
require('fpdf/fpdf.php');
include('../conexion.php');
ini_set("default_charset", "UTF-8");
mb_internal_encoding("UTF-8");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$id = $_GET['id'];
$pdf = new FPDF();
///var_dump(get_class_methods($pdf));

$pdf->AddPage();



$query1 = mysqli_query($conexion, "SELECT * FROM configuracion");
$result1 = mysqli_num_rows($query1);
while ($data1 = mysqli_fetch_assoc($query1)) {

$pdf->SetFont('Arial','',10);
$pdf->SetTitle('Sacramentos');
$pdf->Ln();
///pruebas
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(0, 8, $data1['parroquia'], 0, 1,'C');
$pdf->Cell(0, 8, $data1['diocesis'], 0, 1,'C');
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 8, $data1['direccion'], 0, 1,'C');
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(0, 8, 'Tel. '.$data1['telefono'], 0, 1,'C');
$pdf->SetFont('Arial', '', 18);
$pdf->SetTextColor(220,50,50);
$pdf->Cell(0, 8, 'CONSTANCIA DE BAUTISMO', 0, 1,'C');

	

			
		
 }


$query = mysqli_query($conexion, "SELECT * FROM bautismo 
JOIN madre ON bautismo.idmadre = madre.idmadre
JOIN padre ON bautismo.idpadre = padre.idpadre
JOIN madrina ON bautismo.idmadrina = madrina.idmadrina
JOIN padrino ON bautismo.idpadrino = padrino.idpadrino
JOIN ministro ON bautismo.idministro = ministro.idministro
WHERE idbautismo='$id'");
$result = mysqli_num_rows($query);
while ($data = mysqli_fetch_assoc($query)) {

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

	function fecha2(){
		$dia = array("","Lunes",
					  "Martes",
					  "Miercoles",
					  "Jueves",
					  "Viernes",
					  "Sabado",
					  "Domingo",
					  "Agosto");
		return $dia[date('d')];
	}


    
	$pdf->Ln(2);
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Write(8,'     El infrascrito Parroco de esta parroquia CERTIFICA que segun consta en Partida No. ');
	$pdf->SetTextColor(220,50,50);
	$pdf->Write(8,$data['partida']);
	$pdf->Ln();
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Write(8,'           Folio No. ');
	$pdf->SetTextColor(220,50,50);
	$pdf->Write(8,$data['folio']);
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Write(8,'   Libro.    ');
	$pdf->SetTextColor(220,50,50);
	$pdf->Write(8,$data['libro']);
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Write(8,'   se encuentra la fe de Bautismo en donde consta que,   ');
    $pdf->Ln();

	$pdf->Write(8,'En la Parroquia de ');
	$pdf->SetTextColor(220,50,50);
	$pdf->Write(8,'   San Lucas Evangelista   ');
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Write(8,'el dia       ');
	$pdf->SetFont('Arial','B',12).
	$pdf->Write(8,fecha());
	$pdf->Ln();
	$pdf->SetFont('Arial','',12);
	$pdf->Write(8,'Se bautizo a               ');
	$pdf->SetTextColor(34,74,190);
//	$pdf->Write(8,$data['nombre']);
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->SetFont('Arial','',12).
	$pdf->Write(8,'               que nacio el           ');
	$pdf->SetFont('Arial','B',12).
	$pdf->Write(8,$data['fecha']);
	$pdf->Ln();
	$pdf->SetFont('Arial','',12).
	$pdf->Write(8,'En   ');
	$pdf->SetFont('Arial','B',12).
//	$pdf->Write(8,$data['nombrelugar']);
	$pdf->SetFont('Arial','',12).
	$pdf->Write(8,'   Municipio de   ');
	$pdf->SetFont('Arial','B',12).
//	$pdf->Write(8,$data['nombremunicipio']);
	$pdf->SetFont('Arial','',12).
	$pdf->Write(8,'   Departamento   ');
	$pdf->SetFont('Arial','B',12).
//	$pdf->Write(8,$data['nombredepartamento']);
	$pdf->SetFont('Arial','',12).
	$pdf->Ln();
	$pdf->Write(8,'Hija(o) de          ');
	$pdf->SetFont('Arial','B',12).
//	$pdf->Write(8,utf8_decode($data['nombremadre']));
	$pdf->SetFont('Arial','',12).
	$pdf->Write(8,'           y de           ');
	$pdf->SetFont('Arial','B',12).
//	$pdf->Write(8,$data['nombrepadre']);
	$pdf->Ln();
	$pdf->SetFont('Arial','',12).
	$pdf->Write(8,'Fueron sus Padrinos      ');
	$pdf->SetFont('Arial','B',12).
//	$pdf->Write(8,$data['nombremadrina']);
	$pdf->SetFont('Arial','',12).
	$pdf->Write(8,'           y            ');
	$pdf->SetFont('Arial','B',12).
//	$pdf->Write(8,$data['nombrepadrino']);
	$pdf->Ln();
	$pdf->SetFont('Arial','',12).
	$pdf->Write(8,'Ministro celebrante  ');
	$pdf->SetFont('Arial','B',12).
	$pdf->Write(8,$data['nombreministro']);
	$pdf->Ln();
	$pdf->SetFont('Arial','',12).
	$pdf->Write(8,'Observaciones  ');
	$pdf->SetFont('Arial','B',12).
	$pdf->Write(8,$data['observaciones']);
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial','',12).
	$pdf->Write(8,'                                      San Lucas Toliman Solola, '.fecha().'                  '.date('d-m-Y'));
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Cell(0, 8, 'Oficina Parroquial', 0, 1,'C');			
		
 }



$pdf->Output();

?>

