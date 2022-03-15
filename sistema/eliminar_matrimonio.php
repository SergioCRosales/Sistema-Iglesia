<?php
if (!empty($_GET['id'])) {
    require("../conexion.php");
    $id = $_GET['id'];
    $query_delete = mysqli_query($conexion, "DELETE FROM matrimonio WHERE idmatrimonio = $id");
    mysqli_close($conexion);
    header("location: lista_matrimonio.php");
}
?>