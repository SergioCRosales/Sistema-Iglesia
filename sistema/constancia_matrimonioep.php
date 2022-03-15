<?php
require('fpdf/fpdf.php');
include('../conexion.php');
ini_set("default_charset", "UTF-8");
mb_internal_encoding("UTF-8");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$id = $_GET['id'];
$pdf = new FPDF('P','mm', array(215.9,279.4));
///var_dump(get_class_methods($pdf));

$pdf->AddPage();



$query1 = mysqli_query($conexion, "SELECT * FROM configuracion");
$result1 = mysqli_num_rows($query1);
while ($data1 = mysqli_fetch_assoc($query1)) {

$pdf->SetFont('Times','',10);
$pdf->SetTitle('Sacramentos');
$pdf->Ln(25);
///pruebas
$pdf->Image('img/matrimonio.jpg' , 10 , 33, 35 , 37,'JPG');
$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(0, 6, 'Parroquia '.utf8_decode($data1['parroquia']), 0, 1,'C');
$pdf->SetFont('Times','',14);
$pdf->Cell(0, 6, utf8_decode($data1['diocesis']), 0, 1,'C');
$pdf->SetFont('Times', 'B'.'I', 12);
$pdf->Cell(0, 6, utf8_decode($data1['municipio'].', '.$data1['departamento'].', Guatemala, C. A.'), 0, 1,'C');
$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(0, 8, 'Tel. '.$data1['telefono'], 0, 1,'C');
$pdf->SetFont('Times', 'B', 14);
$pdf->Ln(8);
$pdf->Cell(0, 7, 'CONSTANCIA MATRIMONIAL', 0, 1,'C');
$pdf->Ln();

 }


$query = mysqli_query($conexion, "SELECT
cnf.parroquia,
cnf.municipio as nombremunicipio,
cnf.departamento as nombredepartamento,
m1.partida,
m1.folio,
m1.libro,
m1.fecha,
f3.nombre as testiga,
f4.nombre as testigo,
f1.nombre as nombreesposo,
m1.edadesposo,
l.nombrelugar as lugaresposo,
p1.nombreparroquia as parroquiaesposo,
f5.nombre as padreesposo,
f6.nombre as madreesposo,
f2.nombre as nombreesposa,
m1.edadesposa,
l2.nombrelugar as lugaresposa,
p2.nombreparroquia as parroquiaesposa,
f7.nombre as padreesposa,
f8.nombre as madreesposa,
mn1.nombreministro as ministro,
m1.observaciones
FROM matrimonioep as m1
JOIN feligresesep as f1 on m1.idfeligres = f1.idfeligres
JOIN feligresesep as f2 on m1.idfeligres2 = f2.idfeligres
JOIN testigaep as t1 on m1.idtestiga = t1.idtestiga
JOIN feligresesep as f3 on t1.idfeligreses = f3.idfeligres
JOIN testigoep as t2 on m1.idtestigo = t2.idtestigo
JOIN feligresesep as f4 on t2.idfeligreses = f4.idfeligres
JOIN lugar as l on f1.idlugar = l.idlugar
JOIN parroquia as p1 on f1.idparroquia = p1.idparroquia
JOIN padreep as pd1 on m1.idpadre = pd1.idpadre
JOIN feligresesep as f5 on pd1.idfeligreses = f5.idfeligres
JOIN madreep as md1 on m1.idmadre = md1.idmadre
JOIN feligresesep as f6 on md1.idfeligreses = f6.idfeligres
JOIN lugar as l2 on f2.idlugar = l2.idlugar
JOIN parroquia as p2 on f2.idparroquia = p2.idparroquia
JOIN padreep as pd2 on m1.idpadre2 = pd2.idpadre
JOIN feligresesep as f7 on pd2.idfeligreses = f7.idfeligres
JOIN madreep as md2 on m1.idmadre2 = md2.idmadre
JOIN feligresesep as f8 on md2.idfeligreses = f8.idfeligres
JOIN ministro as mn1 on m1.idministro = mn1.idministro
CROSS JOIN
configuracion as cnf
WHERE idmatrimonio ='$id'");
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



    $fechaf = $data['fecha'];
	$dataf = new DateTime($fechaf);
	$fecham = $dataf->format('d');
	$fecham2 = $mes[$dataf->format('n')];
	$fecham3 = $dataf->format('Y');
   
	


	$pdf->Ln(2);
	$pdf->SetFont('Times','',12);
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Write(7,utf8_decode('             El infrascrito Párroco de esta parroquia'));
	$pdf->SetFont('Times','B',12);
	$pdf->Write(7,' CERTIFICA');
	$pdf->SetFont('Times','',12);
	$pdf->Write(7,utf8_decode(' que según consta en Partida No. '));
	$pdf->SetFont('Times','B'.'U',12);
	$pdf->Write(7,'   '.$data['partida'].'   ');
	$pdf->Ln();
	$pdf->SetFont('Times','',12);
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Write(7,'                Folio No.  ');
	$pdf->SetFont('Times','B'.'U',12);
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Write(7,'   '.$data['folio'].'   ');
	$pdf->SetFont('Times','',12);
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Write(7,'    Libro.   ');
	$pdf->SetFont('Times','B'.'U',12);
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Write(7,'   '.$data['libro'].'   ');
	$pdf->SetFont('Times','',12);
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Write(7,'   se encuentra la fe de Matrimonio que literalmente dice:   ');
    $pdf->Ln(10);

	$pdf->Write(7,'En la Parroquia de  ');
	$pdf->SetFont('Times','B'.'U',12);
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Write(7,'             '.utf8_decode($data['parroquia']).'             ');
	$pdf->SetFont('Times','',12);
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Write(7,'  a  ');
	$pdf->SetFont('Times','B'.'U',12);
	$pdf->Write(7,'   '.$fecham.'   ');
	$pdf->SetFont('Times','',12);
	$pdf->Write(7,'  de  ');
	$pdf->SetFont('Times','B'.'U',12);
	$pdf->Write(7,'   '.$fecham2.'   ');
	$pdf->SetFont('Times','',12);
	$pdf->Write(7, utf8_decode('  del año  '));
	$pdf->SetFont('Times','B'.'U',12);
	$pdf->Cell(0, 7, utf8_decode('   '.$fecham3.'   '), 0, 1,'R');
	$pdf->SetFont('Times','',12).
	$pdf->Cell(0, 7, utf8_decode('previos   los   trámites   de   Derecho   y   no   habiendo   impedimento   Canónico   presencié   y  Bendije  ante  mí'), 0, 1,'j');
	
	$pdf->SetFont('Times','',12);
	$pdf->Write(7,'y ante los testigos   ');
	$pdf->SetFont('Times','B'.'U',12).

	$pdf->Write(7,'         '.utf8_decode($data['testiga']).'         ');
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->SetFont('Times','',12).
	$pdf->Write(7,'    y   ');
	$pdf->SetFont('Times','B'.'U',12).
	$pdf->Cell(0, 7, '     '.utf8_decode($data['testigo'].'     '), 0, 1,'R');
	

	$pdf->SetFont('Times','',12).
	$pdf->Write(7,'el Matrimonio de     ');
	$pdf->SetFont('Times','B'.'U',12).
	$pdf->SetTextColor(220,50,50);
	$pdf->Write(7, '               '.utf8_decode($data['nombreesposo']).'               ');
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->SetFont('Times','',12).
	$pdf->Write(7,'       de       ');
	$pdf->SetFont('Times','B'.'U',12).
	$pdf->Write(7, '   '.utf8_decode($data['edadesposo']).'   ');
	$pdf->SetFont('Times','',12).
	$pdf->Cell(0, 7, utf8_decode('años de edad'), 0, 1,'R');
	$pdf->Write(7,'originario de    ');
	$pdf->SetFont('Times','B'.'U',12).
	$pdf->Write(7,'            '.utf8_decode($data['lugaresposo']).'            ');
	$pdf->SetFont('Times','',12).
	$pdf->Write(7,'      feligres de                ');
	$pdf->SetFont('Times','B'.'U',12).
	$pdf->Cell(0, 7, utf8_decode('   '.$data['parroquiaesposo']).'     ', 0, 1,'R');
	$pdf->SetFont('Times','',12).
	$pdf->Write(7,'hijo de    ');
	$pdf->SetFont('Times','B'.'U',12).
	$pdf->Write(7,'         '.utf8_decode($data['padreesposo']).'         ');
	$pdf->SetFont('Times','',12).
	$pdf->Write(7,'     y  de      ');
	$pdf->SetFont('Times','B'.'U',12).
	$pdf->Cell(0, 7, '      '.utf8_decode($data['madreesposo']).'     ', 0, 1,'R');
	$pdf->SetFont('Times','',12).
	$pdf->Write(7,'con          ');
	$pdf->SetFont('Times','B'.'U',12).
	$pdf->SetTextColor(220,50,50);
	$pdf->Write(7,'                  '.utf8_decode($data['nombreesposa']).'                  ');
	$pdf->SetFont('Times','',12).
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Write(7,'        de        ');
	$pdf->SetFont('Times','B'.'U',12).
	$pdf->write(7, '   '.utf8_decode($data['edadesposa']).'   ');
	$pdf->SetFont('Times','',12).
	$pdf->Cell(0, 7, utf8_decode('  años de edad'), 0, 1,'R');
	$pdf->Write(7,'originario de        ');
	$pdf->SetFont('Times','B'.'U',12).
	$pdf->Write(7,'            '.utf8_decode($data['lugaresposa']).'            ');
	$pdf->SetFont('Times','',12).
	$pdf->Write(7,'      feligres de                ');
	$pdf->SetFont('Times','B'.'U',12).
	$pdf->Cell(0, 7, utf8_decode('   '.$data['parroquiaesposa']).'     ', 0, 1,'R');
	$pdf->SetFont('Times','',12).
	$pdf->Write(7,'hijo de      ');
	$pdf->SetFont('Times','B'.'U',12).
	$pdf->Write(7,'          '.utf8_decode($data['padreesposa']).'          ');
	$pdf->SetFont('Times','',12).
	$pdf->Write(7,'        y  de        ');
	$pdf->SetFont('Times','B'.'U',12).
	$pdf->Cell(0, 7, '     '.utf8_decode($data['madreesposa']).'     ', 0, 1,'R');
	$pdf->SetFont('Times','',12).
	$pdf->Write(7,'Celebrante   ');
	$pdf->SetFont('Times','B',12).
	$pdf->Write(7,'                                             '.$data['ministro']);
	$pdf->SetFont('Arial','',11).
	$pdf->Cell(0, 7, '________________________________________________________________________________', 0, 0,'R');


	$pdf->Ln(15);
	$pdf->Write(7,'Observaciones:  ');
	$pdf->SetFont('Times','B'.'U',12).
	$pdf->Write(7, utf8_decode($data['observaciones']));
	$pdf->SetFont('Arial','',11).
	$pdf->Cell(0, 7, '____________________________________________________________________________', 0, 1,'R');
	$pdf->Cell(0, 7, '__________________________________________________________________________________________', 0, 1,'R');
	$pdf->Ln(10);
	$pdf->SetFont('Times','I',11).
	$pdf->Cell(0, 7, utf8_decode($data['nombremunicipio'].', '.$data['nombredepartamento'].', '.fecha()), 0, 1,'R');
	$pdf->Ln(8);
	$pdf->SetFont('Times','',11).
	$pdf->Cell(0, 7, 'Oficina Parroquial ', 0, 1,'C');


			
		
 }



$pdf->Output();

?>

