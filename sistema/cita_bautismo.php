<?php
require('fpdf/fpdf.php');
include('../conexion.php');
ini_set("default_charset", "UTF-8");
mb_internal_encoding("UTF-8");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$id = $_GET['id'];
$pdf = new FPDF('P','mm', array(215.9,330));
///var_dump(get_class_methods($pdf));

$pdf->AddPage();


$query = mysqli_query($conexion, "SELECT
b.idbautismo,
b.partida,
b.folio,
b.libro,
conf.parroquia,
b.fecha,
f.nombre, 
f.fechanacimiento,
l.nombrelugar,
mn.nombremunicipio as municipio,
dp.nombredepartamento as departamento,
f1.nombre as madre,
f2.nombre as padre,
f3.nombre as madrina,
f4.nombre as padrino,
mt.nombreministro as ministro,
b.observaciones,
b.orden
FROM bautismo as b
JOIN feligreses as f on b.idfeligres = f.idfeligres
JOIN departamento as dp on f.iddepartamento = dp.iddepartamento
JOIN municipio as mn on f.idmunicipio = mn.idmunicipio
JOIN lugar l on f.idlugar = l.idlugar
JOIN configuracion as conf on f.idconfiguracion = conf.idconfiguracion
JOIN madre md on b.idmadre = md.idmadre
JOIN feligreses as f1 on md.idfeligres = f1.idfeligres
JOIN padre pd on b.idpadre = pd.idpadre
JOIN feligreses as f2 on pd.idfeligres = f2.idfeligres
JOIN madrina as mdr on b.idmadrina = mdr.idmadrina
JOIN feligreses as f3 on mdr.idfeligres = f3.idfeligres
JOIN padrino as pdr on b.idpadrino = pdr.idpadrino
JOIN feligreses as f4 on pdr.idfeligres = f4.idfeligres
JOIN ministro as mt on b.idministro = mt.idministro
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
	$fechabautismo = $dataf->format('d')." de ".$mes[$dataf->format('n')]." del año ".$dataf->format('Y');
   
	$fechabau = $data['fechanacimiento'];
	$datab = new DateTime($fechabau);
	$fechanacimiento = $datab->format('d')." de ".$mes[$datab->format('n')]." del año ".$datab->format('Y');


	
	
	$pdf->Ln(2);
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Write(8,utf8_decode('        El infrascrito Párroco de esta parroquia'));
	$pdf->SetFont('Arial','B',12);
	$pdf->Write(8,' CERTIFICA');
	$pdf->SetFont('Arial','',12);
	$pdf->Write(8,utf8_decode(' que según consta en Partida No. '));
	$pdf->SetFont('Arial','B',12);
	$pdf->SetTextColor(220,50,50);
	$pdf->Write(8,$data['partida']);
	$pdf->Ln();
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Write(8,'              Folio No. ');
	$pdf->SetFont('Arial','B',12);
	$pdf->SetTextColor(220,50,50);
	$pdf->Write(8,$data['folio']);
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Write(8,'   Libro.    ');
	$pdf->SetFont('Arial','B',12);
	$pdf->SetTextColor(220,50,50);
	$pdf->Write(8,$data['libro']);
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Write(8,'   se encuentra la fe de Bautismo en donde consta que,   ');
    $pdf->Ln();

	$pdf->Write(8,'En la Parroquia de         ');
	$pdf->SetFont('Arial','B',12);
	$pdf->SetTextColor(220,50,50);
	$pdf->Write(8,utf8_decode($data['parroquia']));
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Write(8,utf8_decode('         el día          '));
	$pdf->SetFont('Arial','B',12).
	$pdf->Cell(0, 8, utf8_decode($fechabautismo), 0, 1,'R');
	



	$pdf->SetFont('Arial','',12);
	$pdf->Write(8,utf8_decode('Se bautizó a   '));
	$pdf->SetFont('Arial','B',12);
	$pdf->SetTextColor(34,74,190);
	$pdf->Write(8,utf8_decode($data['nombre']));
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->SetFont('Arial','',12).
	$pdf->Write(8,utf8_decode('   que nació el   '));
	$pdf->SetFont('Arial','B',12).
	$pdf->Cell(0, 8, utf8_decode($fechanacimiento), 0, 1,'R');
	
	$pdf->Ln(4);

	

	$pdf->SetFont('Arial','',12).
	$pdf->Write(8,'En     ');
	$pdf->SetFont('Arial','B',12).
	$pdf->Write(8,utf8_decode($data['nombrelugar']));
	$pdf->SetFont('Arial','',12).
	$pdf->Write(8,'      Municipio de      ');
	$pdf->SetFont('Arial','B',12).
	$pdf->Write(8,utf8_decode($data['municipio']));
	$pdf->SetFont('Arial','',12).
	$pdf->Write(8,'      Departamento      ');
	$pdf->SetFont('Arial','B',12).
	$pdf->Cell(0, 8, utf8_decode($data['departamento']), 0, 1,'R');
	$pdf->SetFont('Arial','',12).
	$pdf->Write(8,'Hija(o) de            ');
	$pdf->SetFont('Arial','B',12).
	$pdf->Write(8,utf8_decode($data['madre']));
	$pdf->SetFont('Arial','',12).
	$pdf->Write(8,'            y  de          ');
	$pdf->SetFont('Arial','B',12).
	$pdf->Cell(0, 8, utf8_decode($data['padre']), 0, 1,'R');
	$pdf->SetFont('Arial','',12).
	$pdf->Write(8,'Fueron sus Padrinos        ');
	$pdf->SetFont('Arial','B',12).
	$pdf->Write(8,utf8_decode($data['madrina']));
	$pdf->SetFont('Arial','',12).
	$pdf->Write(8,'           y          ');
	$pdf->SetFont('Arial','B',12).
	$pdf->Cell(0, 8, utf8_decode($data['padrino']), 0, 1,'R');
	$pdf->SetFont('Arial','',12).
	$pdf->Write(8,'Ministro celebrante  ');
	$pdf->SetFont('Arial','B',12).
	$pdf->Write(8,utf8_decode($data['ministro']));
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetTextColor(34,74,190);
	$pdf->SetFont('Arial','B',14).
	$pdf->Cell(0, 8, 'Orden del Dia', 0, 1,'C');
	$pdf->Cell(0, 8, $data['orden'], 0, 1,'C');	
	
	$pdf->SetTextColor(5, 5, 5 );
	$pdf->Ln(8);
	$pdf->SetFont('Arial','',10.75).
	$pdf->Cell(0, 8, 'Nota importante.', 0, 1,'C');
	$pdf->MultiCell(195,7, utf8_decode("Favor de no tirar la basura dentro de la iglesia ni en el atrio parroquial ni mucho menos en los jardines, depositelo
	en un basurero o guardelo para luego colocarlo en el tonel de basura, respetar la misa de 9 y media. Para cuando
	terminen los bautizos pare a la oficina para sus documentos; esperamos su amable cooperación, amabilidad y  "), 1,0);
	

		
 }



$pdf->Output();

?>

