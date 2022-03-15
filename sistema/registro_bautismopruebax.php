<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['nombre'])) {
        $alert = '<div class="alert alert-danger" role="alert">
                                    Todo los campos son obligatorio
                                </div>';
    } else {
    
        $cui = $_POST['cui'];
        $partida = $_POST['partida'];
        $folio = $_POST['folio'];
        $libro = $_POST['libro'];
        $idconfiguracion = $_POST['idconfiguracion'];
        $fecha = $_POST['fecha'];
        $nombre = $_POST['nombre'];
        $idlugar = $_POST['idlugar'];
        $idmunicipio = $_POST['idmunicipio'];
        $iddepartamento = $_POST['iddepartamento'];
        $idmadre = $_POST['idmadre'];
        $idpadre = $_POST['idpadre'];
        $idmadrina = $_POST['idmadrina'];
        $idpadrino = $_POST['idpadrino'];
        $idministro = $_POST['idministro'];
        $observaciones = $_POST['observaciones'];

        $usuario_id = $_SESSION['idUser'];

        $result = 0;
        if (is_numeric($cui) and $cui != 0) {
            $query = mysqli_query($conexion, "SELECT * FROM bautismo where cui = '$cui'");
            $result = mysqli_fetch_array($query);
        }
        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                                    El CUI ya existe
                                </div>';
        } else {
            $query_insert = mysqli_query($conexion, "INSERT INTO bautismo(cui,partida,folio,libro,idconfiguracion,fecha,nombre,idlugar,idmunicipio,iddepartamento,idmadre,idpadre,idmadrina,idpadrino,idministro,observaciones) values ('$cui', '$partida', '$folio', '$libro', '$idconfiguracion', '$fecha', '$nombre', '$idlugar', '$idmunicipio', '$iddepartamento', '$idmadre', '$idpadre', '$idmadrina', '$idpadrino', '$idministro', '$observaciones')");
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
    header("location: registro_bautismoprueba.php");
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Datos bautisado</h1>
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
                    <label >Parroquia</label>
                    <select  name="idconfiguracion" id="idconfiguracion"  class="form-control">
                    <?php
                      $query_configuracion = mysqli_query($conexion, "SELECT idconfiguracion, parroquia FROM configuracion ORDER BY parroquia ASC")
                                                            or die('error '.mysqli_error($conexion));
                      while ($data_configuracion = mysqli_fetch_assoc($query_configuracion)) {
                        echo"<option value=\"$data_configuracion[idconfiguracion]\"> $data_configuracion[parroquia] </option>";
                      }
                    ?>
                    </select></div>
                              
                <div class="form-group">
                    <label for="fecha">Fecha nacimiento</label>
                    <input type="date" placeholder="Ingrese fecha nacimiento del bautizado" name="fecha" id="fecha" class="form-control">
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre del bautizado</label>
                    <input type="text" placeholder="Ingrese nombre del bautizado" name="nombre" id="nombre" class="form-control">
                </div>

                <div class="form-group">
                    <label >Lugar</label>
                    <select name="idlugar" id="idlugar" class="form-control">
                    <?php
                      $query_lugar = mysqli_query($conexion, "SELECT idlugar, nombrelugar FROM lugar ORDER BY nombrelugar ASC")
                                                            or die('error '.mysqli_error($conexion));
                      while ($data_lugar = mysqli_fetch_assoc($query_lugar)) {
                        echo"<option value=\"$data_lugar[idlugar]\"> $data_lugar[nombrelugar] </option>";
                      }
                    ?>
                    </select></div>

                    <div class="form-group">
                    <label >Municipio</label>
                    <select name="idmunicipio" id="idmunicipio" class="form-control">
                    <?php
                      $query_municipio = mysqli_query($conexion, "SELECT idmunicipio, nombremunicipio FROM municipio ORDER BY nombremunicipio ASC")
                                                            or die('error '.mysqli_error($conexion));
                      while ($data_municipio = mysqli_fetch_assoc($query_municipio)) {
                        echo"<option value=\"$data_municipio[idmunicipio]\"> $data_municipio[nombremunicipio] </option>";
                      }
                    ?>
                    </select></div>

                    <div class="form-group">
                    <label >Departamento</label>
                    <select name="iddepartamento" id="iddepartamento" class="form-control">
                    <?php
                      $query_departamento = mysqli_query($conexion, "SELECT iddepartamento, nombredepartamento FROM departamento ORDER BY nombredepartamento ASC")
                                                            or die('error '.mysqli_error($conexion));
                      while ($data_departamento = mysqli_fetch_assoc($query_departamento)) {
                        echo"<option value=\"$data_departamento[iddepartamento]\"> $data_departamento[nombredepartamento] </option>";
                      }
                    ?>
                    </select></div>

                    <div class="form-group">
                    <label >Madre</label>
                    <select name="idmadre" id="idmadre" class="form-control">
                    <?php
                      $query_madre = mysqli_query($conexion, "SELECT idmadre, nombremadre FROM madre ORDER BY nombremadre ASC")
                                                            or die('error '.mysqli_error($conexion));
                      while ($data_madre = mysqli_fetch_assoc($query_madre)) {
                        echo"<option value=\"$data_madre[idmadre]\"> $data_madre[nombremadre] </option>";
                      }
                    ?>
                    </select></div>

                    <div class="form-group">
                    <label >Padre</label>
                    <select name="idpadre" id="idpadre" class="form-control">
                    <?php
                      $query_padre = mysqli_query($conexion, "SELECT idpadre, nombrepadre FROM padre ORDER BY nombrepadre ASC")
                                                            or die('error '.mysqli_error($conexion));
                      while ($data_padre = mysqli_fetch_assoc($query_padre)) {
                        echo"<option value=\"$data_padre[idpadre]\"> $data_padre[nombrepadre] </option>";
                      }
                    ?>
                    </select></div>

                    <div class="form-group">
                    <label >Madrina</label>
                    <select name="idmadrina" id="idmadrina" class="form-control">
                    <?php
                      $query_madrina = mysqli_query($conexion, "SELECT idmadrina, nombremadrina FROM madrina ORDER BY nombremadrina ASC")
                                                            or die('error '.mysqli_error($conexion));
                      while ($data_madrina = mysqli_fetch_assoc($query_madrina)) {
                        echo"<option value=\"$data_madrina[idmadrina]\"> $data_madrina[nombremadrina] </option>";
                      }
                    ?>
                    </select></div>

                    <div class="form-group">
                    <label >Padrino</label>
                    <select name="idpadrino" id="idpadrino" class="form-control">
                    <?php
                      $query_padrino = mysqli_query($conexion, "SELECT idpadrino, nombrepadrino FROM padrino ORDER BY nombrepadrino ASC")
                                                            or die('error '.mysqli_error($conexion));
                      while ($data_padrino = mysqli_fetch_assoc($query_padrino)) {
                        echo"<option value=\"$data_padrino[idpadrino]\"> $data_padrino[nombrepadrino] </option>";
                      }
                    ?>
                    </select></div>

                    <div class="form-group">
                    <label >Ministro</label>
                    <select name="idministro" id="idministro" class="form-control">
                    <?php
                      $query_ministro = mysqli_query($conexion, "SELECT idministro, nombreministro FROM ministro ORDER BY nombreministro ASC")
                                                            or die('error '.mysqli_error($conexion));
                      while ($data_ministro = mysqli_fetch_assoc($query_ministro)) {
                        echo"<option value=\"$data_ministro[idministro]\"> $data_ministro[nombreministro] </option>";
                      }
                    ?>
                    </select></div>

    
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