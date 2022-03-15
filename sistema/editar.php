<?php
include "../conexion.php";
$alert = '';
$parroquia = $_POST['parroquia'];
$diocesiss = $_POST['diocesiss'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];

$actualizar_empresa = mysqli_query($conexion, "UPDATE configuracion SET parroquia = '$parroquia', diocesis = '$diocesiss', telefono = $telefono, direccion = $direccion");
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
 
