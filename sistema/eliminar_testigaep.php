<?php
if (!empty($_GET['id'])) {
    require("../conexion.php");
    $id = $_GET['id'];
    $query_delete = mysqli_query($conexion, "DELETE FROM testigaep WHERE idtestiga = $id");
    mysqli_close($conexion);
    header("location: lista_testigaep.php");
}
?>