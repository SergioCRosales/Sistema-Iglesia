<?php include_once "includes/header.php"; 
include "../conexion.php";
$con = new mysqli("localhost","root","","dbsacramentos");

if(empty( $_POST['fechainicial'])){
  $fechainicial = '0000-00-00';
}else{
  $fechainicial = $_POST['fechainicial'];
}

if(empty( $_POST['fechafinal'])){
  $fechafinal = '9999-12-30';
}else{
  $fechafinal = $_POST['fechafinal'];
}

$sql ="SELECT COUNT(*) as cantidad from bautismo where fecha BETWEEN '$fechainicial' AND '$fechafinal'";
$res = $con->query($sql);

$sql2 ="SELECT SUM(a.uno+b.dos) as cuenta
from (SELECT COUNT(*) as uno FROM comunion where fecha BETWEEN '$fechainicial' AND '$fechafinal') a
CROSS JOIN
(SELECT COUNT(*) as dos FROM comunionep where fecha BETWEEN '$fechainicial' AND '$fechafinal') b;";
$res2 = $con->query($sql2);

$sql3 ="SELECT SUM(a.uno+b.dos) as cuenta
from (SELECT COUNT(*) as uno FROM confirmacion where fecha BETWEEN '$fechainicial' AND '$fechafinal') a
CROSS JOIN
(SELECT COUNT(*) as dos FROM confirmacionep where fecha BETWEEN '$fechainicial' AND '$fechafinal') b;";
$res3 = $con->query($sql3);

$sql4 ="SELECT SUM(a.uno+b.dos+c.tres+d.cuatro) as cuenta
from (SELECT COUNT(*) as uno FROM matrimonio where fecha BETWEEN '$fechainicial' AND '$fechafinal') a
CROSS JOIN
(SELECT COUNT(*) as dos FROM matrimoniocombh where fecha BETWEEN '$fechainicial' AND '$fechafinal') b
CROSS JOIN
(SELECT COUNT(*) as tres FROM matrimoniocombm where fecha BETWEEN '$fechainicial' AND '$fechafinal') c
CROSS JOIN
(SELECT COUNT(*) as cuatro FROM matrimonioep where fecha BETWEEN '$fechainicial' AND '$fechafinal') d;";
$res4 = $con->query($sql4);
?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Cantidad de regitros por cada sacramento</h1>
		<br></br>
	</div>
	<br>

	<!-- Content Row -->
	<div class="row">

		<!-- Earnings (Monthly) Card Example -->
		<a class="col-xl-3 col-md-6 mb-4" href="registro_bautismoprueba.php">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><h6>Bautismo</h6></div>
							<?php $query = mysqli_query($conexion, "SELECT COUNT(*) as cuenta FROM bautismo");
							$result = mysqli_fetch_array($query);
                             ?>

							<div class="h5 mb-0 font-weight-bold text-gray-800"><h4><?php echo $result['cuenta']; ?></h4></div>
							
						</div>
						<div class="col-auto">
							<i class="fas fa-user fa-2x text-gray-300"></i>
						</div>
					</div>
					<div align="center"> <img height="220" width="225" src="img/bautismo.jpg"></div>
				</div>
			</div>
		</a>

		<!-- Earnings (Monthly) Card Example -->
		<a class="col-xl-3 col-md-6 mb-4" href="registro_primeracomunion.php">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1"><h6>Primera comunion<h6></div>
							<?php $query2 = mysqli_query($conexion, "SELECT SUM(a.uno+b.dos) as cuenta
                            from (SELECT COUNT(*) as uno FROM comunion) a
                            CROSS JOIN
                            (SELECT COUNT(*) as dos FROM comunionep) b;
                            ");
							$result2 = mysqli_fetch_array($query2);
                             ?>

							<div class="h5 mb-0 font-weight-bold text-gray-800"><h4><?php echo $result2['cuenta']; ?></h4></div>
							
						</div>
						<div class="col-auto">
							<i class="fas fa-users fa-2x text-gray-300"></i>
						</div>
					</div>
					<div align="center"> <img height="220" width="225" src="img/comunion.jpg"></div>
				</div>
			</div>
		</a>

		<!-- Earnings (Monthly) Card Example -->
		<a class="col-xl-3 col-md-6 mb-4" href="registro_confirmacion.php">
			<div class="card border-left-info shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1"><h6>Confirmacion</h6></div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
								<?php $query3 = mysqli_query($conexion, "SELECT SUM(a.uno+b.dos) as cuenta
                                from (SELECT COUNT(*) as uno FROM confirmacion) a
                                CROSS JOIN
                                (SELECT COUNT(*) as dos FROM confirmacionep) b;
                                ");
							$result3 = mysqli_fetch_array($query3);
                             ?>

							<div class="h5 mb-0 font-weight-bold text-gray-800"><h4><?php echo $result3['cuenta']; ?><h4></div>
								
								</div>
								
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-users fa-2x text-gray-300"></i>
						</div>
					</div>
					<div align="center"> <img height="220" width="225" src="img/confirmacion.jpg"></div>
				</div>
			</div>
		</a>

		<!-- Pending Requests Card Example -->
		<a class="col-xl-3 col-md-6 mb-4" href="registro_matrimonio.php">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><h6>Matrimonio</h6></div>
							<?php $query4 = mysqli_query($conexion, "SELECT SUM(a.uno+b.dos+c.tres+d.cuatro) as cuenta
                            from (SELECT COUNT(*) as uno FROM matrimonio) a
                            CROSS JOIN
                            (SELECT COUNT(*) as dos FROM matrimoniocombh) b
                            CROSS JOIN
                            (SELECT COUNT(*) as tres FROM matrimoniocombm) c
                            CROSS JOIN
                            (SELECT COUNT(*) as cuatro FROM matrimonioep) d;");
							$result4 = mysqli_fetch_array($query4);
                             ?>

							<div class="h5 mb-0 font-weight-bold text-gray-800"><h4><?php echo $result4['cuenta']; ?><h4></div>
							
						</div>
						<div class="col-auto">
							<i class="fas fa-users fa-2x text-gray-300"></i>
						</div>
					</div>
					<div align="center"> <img height="220" width="225" src="img/matrimonio.jpg"></div>
				</div>
			</div>
		</a>
	</div>

	
       

    
      
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Sacramentos', 'Numero de Registros'],
        <?php
        while($fila = $res->fetch_assoc()){
           echo "['".'Bautismo'."',".$fila["cantidad"]."],";
        }
        while($fila2 = $res2->fetch_assoc()){
          echo "['".'Primeracomunion'."',".$fila2["cuenta"]."],";
       }
       while($fila3 = $res3->fetch_assoc()){
        echo "['".'Confirmacion'."',".$fila3["cuenta"]."],";
     }
     while($fila4 = $res4->fetch_assoc()){
      echo "['".'Matrimonio'."',".$fila4["cuenta"]."],";
   }




        ?>
          
         
        ]);
		

        var options = {
          title: 'Cantidad de registros por sacramentos',
		 
        };
        
        

		var chart = new google.visualization.ColumnChart(document.getElementById('piechart'));
	
		

        chart.draw(data, options);
	
	  }
	  $(window).resize(function(){
        drawChart();
      });
	  
    </script>
  </head>
  <body>
  
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
  <div id="piechart" style="width: 100%; height: 500px;"></div>
 
  <br>
  </div>
			</div>
		</a>
	</div>
	</body>
				
  </body>
  
 
	

	<br></br>
	<br></br>
	
	<br></br>
	<br></br>
	
	<br></br>
	<br></br>

	
	<br></br>
	<br></br>

	
	<br></br>
	<br></br>
	
	<div class="text-center">
        <div class="btn-group" role="group" aria-label="">

        <form action="" method="post" autocomplete="on">

      <div class="form-group">
					<div >Ingrese fechas para mostrar la cantidad de registros por sacramentos </div>
					<br>
                    <div >De &nbsp;&nbsp;
                    <input type="date" placeholder="Ingrese fecha nacimiento del bautizado" name="fechainicial" id=""   >
                    <label for="fechanacimiento">&nbsp;&nbsp;Hasta&nbsp;&nbsp;</label>
                    <input type="date" placeholder="Ingrese fecha nacimiento del bautizado" name="fechafinal" id=""  ></div>
                </div>

               
     
                <input type="submit" value="Ingresar" class="btn btn-primary">
        </div>

</form>
	  </div>
	  
	 
			 
		<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		

		<?php  ?>
	</div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


 

  






<?php include_once "includes/footer.php"; ?>