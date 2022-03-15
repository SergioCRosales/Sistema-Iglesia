<?php
if (!empty($_GET['id'])) {
    require("../conexion.php");
    $id = $_GET['id'];
    $query_delete = mysqli_query($conexion, "DELETE FROM padrino WHERE idpadrino = $id");
    mysqli_close($conexion);
    header("location: lista_padrino.php");
}
?>