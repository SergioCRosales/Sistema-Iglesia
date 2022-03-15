<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    
	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
	 <?php include "../conexion.php";
						$query = mysqli_query($conexion, "SELECT * FROM configuracion");
						$result = mysqli_num_rows($query);
						
					$data = mysqli_fetch_assoc($query);  ?>
		<div style="color: aqua;" class="sidebar-brand-text mx-3"><?php echo 'PARROQUIA '.$data['parroquia']; ?> </div>

		

	</a>

	<!-- Divider -->
	<hr class="sidebar-divider my-0">

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	

	<!-- Nav Item - Pages Collapse Menu -->
	<li class="nav-item">
		<br></br>
		<a class="nav-link" href="index.php">
		<i class="fas fa-fw fa-church"></i>
		<span>Inicio</span>
	</a>
	</li>
	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwosxs" aria-expanded="true" aria-controls="collapseTwosxs">
			<i class="fas fa-fw fa-user"></i>
			<span>Feligreses</span>
		</a>
		<div id="collapseTwosxs" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="registro_feligreses.php">Nuevo registro</a>
				<a class="collapse-item" href="lista_feligreses.php">Mis registros</a>
			</div>
		</div>
	</li>
	</li>
	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwos" aria-expanded="true" aria-controls="collapseTwos">
			<i class="fas fa-fw fa-user"></i>
			<span>Padres, padrinos <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  y testigos</span>
		</a>
		<div id="collapseTwos" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="registro_madre2.php">Nuevo registro</a>
				<a class="collapse-item" href="lista_madre.php">Mis registros</a>
			</div>
		</div>
	</li>

	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwox" aria-expanded="true" aria-controls="collapseTwox">
			<i class="fas fa-fw fa-baby-carriage"></i>
			<span>Bautismos </span>
		</a>
		<div id="collapseTwox" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="registro_bautismoprueba.php">Nuevo registro</a>
				<a class="collapse-item" href="lista_bautismoprueba.php">Mis registros</a>
				<a class="collapse-item" href="reporte_bautismo.php">Reporte</a>
			</div>
		</div>
	</li>




	<!-- Nav Item - Productos Collapse Menu -->
	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
			<i class="fas fa-fw fa-child"></i>
			<span>Primera comunion</span>
		</a>
		<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="registro_primeracomunion.php">Nuevo registro</a>
				<a class="collapse-item" href="lista_primeracomunion.php">Mis registros</a>
				<a class="collapse-item" href="reporte_comunion.php">Reporte</a>
			</div>
		</div>
	</li>

	<!-- Nav Item - Clientes Collapse Menu -->
	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClientes" aria-expanded="true" aria-controls="collapseUtilities">
			<i class="fas fa-male"></i>
			<span>Confirmacion</span>
		</a>
		<div id="collapseClientes" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="registro_confirmacion.php">Nuevo registro</a>
				<a class="collapse-item" href="lista_confirmacion.php">Mis registros</a>
				<a class="collapse-item" href="reporte_confirmacion.php">Reporte</a>
			</div>
		</div>
	</li>
	<!-- Nav Item - Utilities Collapse Menu -->
	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProveedor" aria-expanded="true" aria-controls="collapseUtilities">
			<i class="fas fa-restroom"></i>
			<span>Matrimonio</span>
		</a>
		<div id="collapseProveedor" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="registro_matrimonio.php">Nuevo registro</a>
				<a class="collapse-item" href="lista_matrimonio.php">Mis registros</a>
				<a class="collapse-item" href="reporte_matrimonio.php">Reporte</a>
				<br>
				<a class="collapse-item" href="registro_matrimoniomixtoh.php">Nuevo registro mixto</a>
				<a class="collapse-item" href="lista_matrimoniomixtoh.php">Mis registros mixto</a>
			</div>
		</div>
	</li>
	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProveedorx" aria-expanded="true" aria-controls="collapseUtilities">
			<i class="fas fa-fw fa-street-view"></i>
			<span>Direccion y ministro</span>
		</a>
		<div id="collapseProveedorx" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="registro_lugar.php">Nuevo registro</a>
				<a class="collapse-item" href="lista_lugar.php">Mis registros</a>
			</div>
		</div>
	</li>
	<?php if ($_SESSION['rol'] == 1) { ?>
		<!-- Nav Item - Usuarios Collapse Menu -->
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsuarios" aria-expanded="true" aria-controls="collapseUtilities">
				<i class="fas fa-users-cog"></i>
				<span>Usuarios</span>
			</a>
			<div id="collapseUsuarios" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="registro_usuario.php">Nuevo Usuario</a>
					<a class="collapse-item" href="lista_usuarios.php">Usuarios</a>
				</div>
			</div>
		</li>
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsedatabase" aria-expanded="true" aria-controls="collapseUtilities">
				<i class="fas fa-database"></i>
				<span>Copia de respaldo</span>
			</a>
			<div id="collapsedatabase" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="respaldo.php">Generar copia de <br> respaldo</a>
					
				</div>
			</div>
		</li>
		<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseConf" aria-expanded="true" aria-controls="collapseConf">
			<i class="fas fa-fw fa-cog"></i>
			<span>Configuracion</span>
		</a>
		<div id="collapseConf" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="conf_usuario.php">Mi usuario</a>
				<a class="collapse-item" href="editar_configuracion.php?id=1">Datos parroquia</a>
			
			</div>
		</div>
	</li>
	<?php } else {?>
	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseConf" aria-expanded="true" aria-controls="collapseConf">
			<i class="fas fa-fw fa-cog"></i>
			<span>Configuracion</span>
		</a>
		<div id="collapseConf" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="conf_usuario.php">Mi usuario</a>
			</div>
		</div>
	</li>
	<?php } ?>
</ul>