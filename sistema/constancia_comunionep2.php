<?php
require('fpdf/fpdf.php');
include('../conexion.php');
ini_set("default_charset", "UTF-7");
mb_internal_encoding("UTF-7");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$id = $_GET['id'];
$pdf = new FPDF('P','mm', array(215.9,330));
///var_dump(get_class_methods($pdf));

$pdf->AddPage();



$query1 = mysqli_query($conexion, "SELECT * FROM configuracion");
$result1 = mysqli_num_rows($query1);
while ($data1 = mysqli_fetch_assoc($query1)) {

$pdf->SetFont('Arial','',10);
$pdf->SetTitle('Sacramentos');
$pdf->Ln();
///pruebas
$pdf->Image('img/logoconfirmacion.jpg' , 10 ,10, 30 , 33,'JPG');
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 6, 'Parroquia '.utf8_decode($data1['parroquia']), 0, 1,'C');
$pdf->Cell(0, 6, utf8_decode($data1['diocesis']), 0, 1,'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(0, 6, utf8_decode($data1['direccion']), 0, 1,'C');
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 8, 'Tel. '.$data1['telefono'], 0, 1,'C');
$pdf->SetFont('Arial', 'B', 14.5);
$pdf->Cell(0, 7, utf8_decode('CONSTANCIA DE PRIMERA COMUNION'), 0, 1,'C');

	

			
		
 }


$query = mysqli_query($conexion, "SELECT
c.idcomunion,
c.partida,
c.folio,
c.libro,
pr.nombreparroquia as parroquia,
c.fecha,
f.nombre,
c.fechabautismo,
l.nombrelugar,
mn.nombremunicipio,
d.nombredepartamento,
f1.nombre as madre,
f2.nombre as padre,
f3.nombre as madrina,
f4.nombre as padrino,
mt.nombreministro as ministro,
c.observaciones
FROM comunionep as c
JOIN feligresesep as f on c.idfeligres = f.idfeligres
JOIN parroquia as pr on f.idparroquia = pr.idparroquia
JOIN lugar l on f.idlugar = l.idlugar
JOIN municipio mn on f.idmunicipio = mn.idmunicipio
JOIN departamento d on f.iddepartamento = d.iddepartamento
JOIN madreep md on c.idmadre = md.idmadre
JOIN feligresesep as f1 on md.idfeligreses = f1.idfeligres
JOIN padreep pd on c.idpadre = pd.idpadre
JOIN feligresesep as f2 on pd.idfeligreses = f2.idfeligres
JOIN madrinaep as mdr on c.idmadrina = mdr.idmadrina
JOIN feligresesep as f3 on mdr.idfeligreses = f3.idfeligres
JOIN padrinoep as pdr on c.idpadrino = pdr.idpadrino
JOIN feligresesep as f4 on pdr.idfeligreses = f4.idfeligres
JOIN ministro as mt on c.idministro = mt.idministro
WHERE idcomunion='$id'");
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
	$fechac = $dataf->format('d');
	$fechac2 = $mes[$dataf->format('n')];
	$fechac3 = $dataf->format('Y');

   
	$fechabau = $data['fechabautismo'];
	$datab = new DateTime($fechabau);
	$fechab = $datab->format('d');
	$fechab2 = $mes[$datab->format('n')];
	$fechab3 = $datab->format('Y');

	
	
	$pdf->Ln(2);
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Write(7,utf8_decode('        El infrascrito Párroco de esta parroquia'));
	$pdf->SetFont('Arial','B',12);
	$pdf->Write(7,' CERTIFICA');
	$pdf->SetFont('Arial','',12);
	$pdf->Write(7,utf8_decode(' que según consta en Partida No. '));
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->SetFont('Arial','B'.'U',12);
	$pdf->Write(7,'   '.$data['partida'].'   ');
	$pdf->Ln();
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Write(7,'           Folio No. ');
	$pdf->SetFont('Arial','B'.'U',12);
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Write(7,'   '.$data['folio'].'   ');
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Write(7,'    Libro. ');
	$pdf->SetFont('Arial','B'.'U',12);
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Write(7,'   '.$data['libro'].'   ');
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Write(7,'   se encuentra la fe de Confirmacion que literalmente dice:   ');
    $pdf->Ln(10);

	$pdf->Write(7,'En la Parroquia de   ');
	$pdf->SetFont('Arial','B'.'U',12);
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Write(7,'     '.utf8_decode($data['parroquia']).'     ');
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Write(7,'   a   ');
	$pdf->SetFont('Arial','B'.'U',12);
	$pdf->Write(7,'   '.$fechac.'   ');
	$pdf->SetFont('Arial','',12);
	$pdf->Write(7,'   de   ');
	$pdf->SetFont('Arial','B'.'U',12);
	$pdf->Write(7,'   '.$fechac2.'   ');
	$pdf->SetFont('Arial','',12);
	$pdf->Write(7, utf8_decode('   del año   '));
	$pdf->SetFont('Arial','B'.'U',12);
	$pdf->Cell(0, 7, utf8_decode('   '.$fechac3.'   '), 0, 1,'R');

	
	



	$pdf->SetFont('Arial','',12);
	$pdf->Write(7,utf8_decode('Se confirmó a     '));
	$pdf->SetFont('Arial','B'.'U',12).
	$pdf->SetTextColor(220,50,50);
	$pdf->Write(7,'    '.utf8_decode($data['nombre'].'    '));
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->SetFont('Arial','',12).
	$pdf->Write(7,'     Bautizado el      ');
	$pdf->SetFont('Arial','B'.'U',12);
	$pdf->Write(7,'   '.$fechab.'   ');
	$pdf->SetFont('Arial','',12);
	$pdf->Write(7,'   de   ');
	$pdf->SetFont('Arial','B'.'U',12);
	$pdf->Cell(0, 7, utf8_decode('   '.$fechab2.'   '), 0, 1,'R');
	$pdf->SetFont('Arial','',12);
	$pdf->Write(7, utf8_decode('del año   '));
	$pdf->SetFont('Arial','B'.'U',12);
	$pdf->Write(7,'   '.$fechab3.'   ');
	
	

	$pdf->SetFont('Arial','',12).
	$pdf->Write(7,'   en   ');
	$pdf->SetFont('Arial','B'.'U',12).
	$pdf->Write(7, 'Parroquia '.utf8_decode($data['parroquia']));
	$pdf->SetFont('Arial','',12).
	$pdf->Write(7,'      municipio de      ');
	$pdf->SetFont('Arial','B'.'U',12).
	$pdf->Cell(0, 7, '   '.utf8_decode($data['nombremunicipio']), 0, 1,'R');
	$pdf->SetFont('Arial','',12).
	$pdf->Write(7,'departamento de     ');
	$pdf->SetFont('Arial','B'.'U',12).
	$pdf->Write(7,'              '.utf8_decode($data['nombredepartamento']).'              ');
	$pdf->SetFont('Arial','',12).
	$pdf->Write(7,'      hijo(a) de             ');
	$pdf->SetFont('Arial','B'.'U',12).
	$pdf->Cell(0, 7, utf8_decode('   '.$data['madre']), 0, 1,'R');
	$pdf->SetFont('Arial','',12).
	$pdf->Write(7,'y  de   ');
	$pdf->SetFont('Arial','B'.'U',12).
	$pdf->Write(7,utf8_decode('   '.$data['padre'].'   '));
	$pdf->SetFont('Arial','',12).
	$pdf->Write(7,'   fueron sus padrinos        ');
	$pdf->SetFont('Arial','B'.'U',12).
	$pdf->Cell(0, 7, utf8_decode('   '.$data['madrina']), 0, 1,'R');
	$pdf->SetFont('Arial','',12).
	$pdf->Write(7,'y       ');
	$pdf->SetFont('Arial','B'.'U',12).
	$pdf->Write(7,utf8_decode('   '.$data['padrino'].'   '));
	$pdf->SetFont('Arial','',12).
	$pdf->Write(7,'   ministro celebrante   ');
	$pdf->SetFont('Arial','B'.'U',12).
	$pdf->Cell(0, 7, utf8_decode('   '.$data['ministro']), 0, 1,'R');
	$pdf->Ln();
    $pdf->SetFont('Arial','',12).
	$pdf->Write(7,'Observaciones:  ');
	$pdf->SetFont('Arial','B'.'U',12).
	$pdf->Write(7, utf8_decode($data['observaciones']));
	$pdf->SetFont('Arial','',11).
	$pdf->Cell(0, 7, '___________________________________________________________________________', 0, 1,'R');
	$pdf->Write(7,utf8_decode('Religion del interesado(a): Catolica'));
	$pdf->Cell(0, 7, '__________________________________________________________________________________________', 0, 1,'R');
	$pdf->Cell(0, 7, '__________________________________________________________________________________________', 0, 1,'R');
	$pdf->Cell(0, 7, utf8_decode('San Lucas Tolimán, Sololá, ').fecha(), 0, 1,'R');
	$pdf->Ln(8);
	$pdf->Cell(0, 7, 'Oficina Parroquial ', 0, 1,'C');


			
		
 }



$pdf->Output();

?>

