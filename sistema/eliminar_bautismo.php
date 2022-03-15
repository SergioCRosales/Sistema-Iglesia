<?php
if (!empty($_GET['id'])) {
    require("../conexion.php");
    $id = $_GET['id'];
    $query_delete = mysqli_query($conexion, "DELETE FROM bautismo WHERE idbautismo = $id");
    mysqli_close($conexion);
    header("location: lista_bautismoprueba.php");
}
?>