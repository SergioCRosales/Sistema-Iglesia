<?php
if (!empty($_GET['id'])) {
    require("../conexion.php");
    $id = $_GET['id'];
    $query_delete = mysqli_query($conexion, "DELETE FROM matrimonioep WHERE idmatrimonio = $id");
    mysqli_close($conexion);
    header("location: lista_matrimonioep.php");
}
?>