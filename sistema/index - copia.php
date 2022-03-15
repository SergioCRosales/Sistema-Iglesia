<?php include_once "includes/header.php"; 
include "../conexion.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Cantidad de regitros por cada sacramento</h1>
	</div>

	<!-- Content Row -->
	<div class="row">

		<!-- Earnings (Monthly) Card Example -->
		<a class="col-xl-3 col-md-6 mb-4" href="registro_bautismoprueba.php">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Bautisados</div>
							<?php $query = mysqli_query($conexion, "SELECT COUNT(*) as cuenta FROM bautismo");
							$result = mysqli_fetch_array($query);
                             ?>

							<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $result['cuenta']; ?></div>
							
						</div>
						<div class="col-auto">
							<i class="fas fa-user fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>

		<!-- Earnings (Monthly) Card Example -->
		<a class="col-xl-3 col-md-6 mb-4" href="registro_primeracomunion.php">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Primera comunion</div>
							<?php $query2 = mysqli_query($conexion, "SELECT COUNT(*) as cuenta FROM comunion");
							$result2 = mysqli_fetch_array($query2);
                             ?>

							<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $result2['cuenta']; ?></div>
							
						</div>
						<div class="col-auto">
							<i class="fas fa-users fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>

		<!-- Earnings (Monthly) Card Example -->
		<a class="col-xl-3 col-md-6 mb-4" href="registro_confirmacion.php">
			<div class="card border-left-info shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Confirmacion</div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
								<?php $query3 = mysqli_query($conexion, "SELECT COUNT(*) as cuenta FROM confirmacion");
							$result3 = mysqli_fetch_array($query3);
                             ?>

							<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $result3['cuenta']; ?></div>
								
								</div>
								
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-users fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>

		<!-- Pending Requests Card Example -->
		<a class="col-xl-3 col-md-6 mb-4" href="registro_matrimonio.php">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Matrimonio</div>
							<?php $query4 = mysqli_query($conexion, "SELECT SUM(a.uno+b.dos+c.tres) as cuenta
                            from (SELECT COUNT(*) as uno FROM matrimonio) a
                            CROSS JOIN
                            (SELECT COUNT(*) as dos FROM matrimoniocombh) b
                            CROSS JOIN
                            (SELECT COUNT(*) as tres FROM matrimoniocombm) c;");
							$result4 = mysqli_fetch_array($query4);
                             ?>

							<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $result4['cuenta']; ?></div>
							
						</div>
						<div class="col-auto">
							<i class="fas fa-users fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
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