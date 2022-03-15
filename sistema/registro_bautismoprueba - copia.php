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
                    <select name="idconfiguracion" id="idconfiguracion" class="form-control">
                    <?php
                      $query_obat = mysqli_query($conexion, "SELECT idconfiguracion, parroquia FROM configuracion ORDER BY parroquia ASC")
                                                            or die('error '.mysqli_error($conexion));
                      while ($data_obat = mysqli_fetch_assoc($query_obat)) {
                        echo"<option value=\"$data_obat[idconfiguracion]\"> $data_obat[idconfiguracion] | $data_obat[parroquia] </option>";
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
                      $query_obat = mysqli_query($conexion, "SELECT idlugar, nombre FROM lugar ORDER BY nombre ASC")
                                                            or die('error '.mysqli_error($conexion));
                      while ($data_obat = mysqli_fetch_assoc($query_obat)) {
                        echo"<option value=\"$data_obat[idlugar]\"> $data_obat[idlugar] | $data_obat[nombre] </option>";
                      }
                    ?>
                    </select></div>

                    <div class="form-group">
                    <label >Municipio</label>
                    <select name="idmunicipio" id="idmunicipio" class="form-control">
                    <?php
                      $query_obat = mysqli_query($conexion, "SELECT idmunicipio, nombre FROM municipio ORDER BY nombre ASC")
                                                            or die('error '.mysqli_error($conexion));
                      while ($data_obat = mysqli_fetch_assoc($query_obat)) {
                        echo"<option value=\"$data_obat[idmunicipio]\"> $data_obat[idmunicipio] | $data_obat[nombre] </option>";
                      }
                    ?>
                    </select></div>

                    <div class="form-group">
                    <label >Departamento</label>
                    <select name="iddepartamento" id="iddepartamento" class="form-control">
                    <?php
                      $query_obat = mysqli_query($conexion, "SELECT iddepartamento, nombre FROM departamento ORDER BY nombre ASC")
                                                            or die('error '.mysqli_error($conexion));
                      while ($data_obat = mysqli_fetch_assoc($query_obat)) {
                        echo"<option value=\"$data_obat[iddepartamento]\"> $data_obat[iddepartamento] | $data_obat[nombre] </option>";
                      }
                    ?>
                    </select></div>

                    <div class="form-group">
                    <label >Madre</label>
                    <select name="idmadre" id="idmadre" class="form-control">
                    <?php
                      $query_obat = mysqli_query($conexion, "SELECT idmadre, nombre FROM madre ORDER BY nombre ASC")
                                                            or die('error '.mysqli_error($conexion));
                      while ($data_obat = mysqli_fetch_assoc($query_obat)) {
                        echo"<option value=\"$data_obat[idmadre]\"> $data_obat[idmadre] | $data_obat[nombre] </option>";
                      }
                    ?>
                    </select></div>

                    <div class="form-group">
                    <label >Padre</label>
                    <select name="idpadre" id="idpadre" class="form-control">
                    <?php
                      $query_obat = mysqli_query($conexion, "SELECT idpadre, nombre FROM padre ORDER BY nombre ASC")
                                                            or die('error '.mysqli_error($conexion));
                      while ($data_obat = mysqli_fetch_assoc($query_obat)) {
                        echo"<option value=\"$data_obat[idpadre]\"> $data_obat[idpadre] | $data_obat[nombre] </option>";
                      }
                    ?>
                    </select></div>

                    <div class="form-group">
                    <label >Madrina</label>
                    <select name="idmadrina" id="idmadrina" class="form-control">
                    <?php
                      $query_obat = mysqli_query($conexion, "SELECT idmadrina, nombre FROM madrina ORDER BY nombre ASC")
                                                            or die('error '.mysqli_error($conexion));
                      while ($data_obat = mysqli_fetch_assoc($query_obat)) {
                        echo"<option value=\"$data_obat[idmadrina]\"> $data_obat[idmadrina] | $data_obat[nombre] </option>";
                      }
                    ?>
                    </select></div>

                    <div class="form-group">
                    <label >Padrino</label>
                    <select name="idpadrino" id="idpadrino" class="form-control">
                    <?php
                      $query_obat = mysqli_query($conexion, "SELECT idpadrino, nombre FROM padrino ORDER BY nombre ASC")
                                                            or die('error '.mysqli_error($conexion));
                      while ($data_obat = mysqli_fetch_assoc($query_obat)) {
                        echo"<option value=\"$data_obat[idpadrino]\"> $data_obat[idpadrino] | $data_obat[nombre] </option>";
                      }
                    ?>
                    </select></div>

                    <div class="form-group">
                    <label >Ministro</label>
                    <select name="idministro" id="idministro" class="form-control">
                    <?php
                      $query_obat = mysqli_query($conexion, "SELECT idministro, nombre FROM ministro ORDER BY nombre ASC")
                                                            or die('error '.mysqli_error($conexion));
                      while ($data_obat = mysqli_fetch_assoc($query_obat)) {
                        echo"<option value=\"$data_obat[idministro]\"> $data_obat[idministro] | $data_obat[nombre] </option>";
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