<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['bautizado']) || empty($_POST['madre']) || empty($_POST['madrina'])) {
        $alert = '<div class="alert alert-danger" role="alert">
                                    Todo los campos son obligatorio
                                </div>';
    } else {
    
        $cui = $_POST['cui'];
        $partida = $_POST['partida'];
        $folio = $_POST['folio'];
        $libro = $_POST['libro'];
        $bautizado = $_POST['bautizado'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $lugar = $_POST['lugar'];
        $municipio = $_POST['municipio'];
        $departamento = $_POST['departamento'];
        $madre = $_POST['madre'];
        $padre = $_POST['padre'];
        $madrina = $_POST['madrina'];
        $padrino = $_POST['padrino'];
        $ministro = $_POST['ministro'];
        $observaciones = $_POST['observaciones'];

        $usuario_id = $_SESSION['idUser'];

        $result = 0;
        if (is_numeric($cui) and $cui != 0) {
            $query = mysqli_query($conexion, "SELECT * FROM bautismos where cui = '$cui'");
            $result = mysqli_fetch_array($query);
        }
        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                                    El CUI ya existe
                                </div>';
        } else {
            $query_insert = mysqli_query($conexion, "INSERT INTO bautismos(cui,partida,folio,libro,bautizado,fecha_nacimiento,lugar,municipio,departamento,madre,padre,madrina,padrino,ministro,observaciones,usuario_id) values ('$cui', '$partida', '$folio', '$libro', '$bautizado', '$fecha_nacimiento', '$lugar', '$municipio', '$departamento', '$madre', '$padre', '$madrina', '$padrino', '$ministro', '$observaciones', '$usuario_id')");
            if ($query_insert) {
                $alert = '<div class="alert alert-primary" role="alert">
                                    Registro guardado!
                                </div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                                    Error al Guardar
                            </div>';
            }
        }
    }
    mysqli_close($conexion);
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Datos bautisado</h1>
        <a href="lista_bautismo.php" class="btn btn-primary">Ver listado bautismo</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
            <form action="" method="post" autocomplete="off">
                <?php echo isset($alert) ? $alert : ''; ?>
                <div class="form-group">
                    <label for="cui">CUI</label>
                    <input type="number" placeholder="Ingrese CUI del bautizado" name="cui" id="cui" class="form-control">
                </div>
                <div class="form-group">
                    <label for="partida">No. Partida</label>
                    <input type="number" placeholder="Ingrese numero de partida" name="partida" id="partida" class="form-control">
                </div>
                <div class="form-group">
                    <label for="folio">No. Folio</label>
                    <input type="number" placeholder="Ingrese numero de folio" name="folio" id="folio" class="form-control">
                </div>
                <div class="form-group">
                    <label for="libro">No. Libro</label>
                    <input type="number" placeholder="Ingrese numero de libro" name="libro" id="libro" class="form-control">
                </div>
                <div class="form-group">
                    <label for="bautizado">Nombre del bautizado</label>
                    <input type="text" placeholder="Ingrese nombre del bautizado" name="bautizado" id="bautizado" class="form-control">
                </div>
                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha nacimiento</label>
                    <input type="date" placeholder="Ingrese fecha nacimiento del bautizado" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control">
                </div>
                <div class="form-group">
                    <label for="lugar">Lugar</label>
                    <input type="text" placeholder="Ingrese lugar" name="lugar" id="lugar" class="form-control">
                </div>
                <div class="form-group">
                    <label for="municipio">Municipio</label>
                    <input type="text" placeholder="Ingrese municipio" name="municipio" id="municipio" class="form-control">
                </div>
                <div class="form-group">
                    <label for="departamento">Departamento</label>
                    <input type="text" placeholder="Ingrese departamento" name="departamento" id="partamento" class="form-control">
                </div>
                <div class="form-group">
                    <label for="madre">Madre</label>
                    <input type="text" placeholder="Ingrese nombre de la madre" name="madre" id="madre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="padre">Padre</label>
                    <input type="text" placeholder="Ingrese nombre del padre" name="padre" id="padre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="madrina">Madrina</label>
                    <input type="text" placeholder="Ingrese nombre de la madrina" name="madrina" id="madrina" class="form-control">
                </div>
                <div class="form-group">
                    <label for="padrino">Padrino</label>
                    <input type="text" placeholder="Ingrese nombre del padrino" name="padrino" id="padrino" class="form-control">
                </div>
                <div class="form-group">
                    <label for="ministro">Ministro</label>
                    <input type="text" placeholder="Ingrese nombre del ministro" name="ministro" id="ministro" class="form-control">
                </div>
                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <input type="text" placeholder="Ingrese observaciones" name="observaciones" id="observaciones" class="form-control">
                </div>

                <input type="submit" value="Guardar Registro" class="btn btn-primary">
            </form>
        </div>
    </div>


      
    


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include_once "includes/footer.php"; ?>