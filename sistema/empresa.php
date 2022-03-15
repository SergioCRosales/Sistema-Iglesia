<?php
include "../conexion.php";
$alert = '';
$txtParroquia = $_POST['txtParroquia'];
$txtDiocesis = $_POST['txtDiocesis'];
$txtTelefono = $_POST['txtTelEmpresa'];
$txtDireccion = $_POST['txtDirEmpresa'];
$txtemail = $_POST['txtEmailEmpresa'];
$txtigv = $_POST['txtIgv'];
$actualizar_empresa = mysqli_query($conexion, "UPDATE configuracion SET parroquia = '$txtParroquia', diocesis = '$txtDiocesis', telefono = $txtTelefono, email = '$txtemail', direccion = '$txtDireccion', igv = $txtigv");
mysqli_close($conexion);
if ($actualizar_empresa) {
  $alert = '<p class="msg_save">Configuración de empresa Actualizado</p>';
  header("Location: index.php");
} else {
  $alert = '<p class="msg_error">Error al Actualizar la Configuración de empresa</p>';
}
?>
 <?php
  include "includes/footer.php";
  ?>
 
