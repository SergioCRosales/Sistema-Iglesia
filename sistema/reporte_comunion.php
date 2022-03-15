<?php include_once "includes/header.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>

	<script src="js/jquery.js"></script>
    <script src="js/myjava.js"></script>

</head>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Reporte por fecha Primera Comunion</h1>
		
	</div>

	<div class="row">
		<div class="col-lg-12">

		
    	<tr>
		    
		    <br></br>
			<br></br>
            <div align="center"><td><td>De&nbsp;&nbsp;</td><input type="date" id="bd-desde"/></td>
            <td>&nbsp;&nbsp;Hasta&nbsp;&nbsp;</td>
            <td><input type="date" id="bd-hasta"/></td></div>
			<br></br>
			<br></br>
            <a target="_blank" onClick="javascript:reportePDFcomunion();" ><div align="center"> <img height="110" width="115" src="img/imprimir.jpg"><h4>Imprimir</h4></a>
			<br></br>
			<br></br>
			<br></br>
			
		    
        </tr>

			
	</div>

	


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<?php include_once "includes/footer.php"; ?>