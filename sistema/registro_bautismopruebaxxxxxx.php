<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['idfeligres'])) {
        $alert = '<div class="alert alert-danger" role="alert">
                                    Todo los campos son obligatorio
                                </div>';
    } else {

        $cui = $_POST['cui'];
        $partida = $_POST['partida'];
        $folio = $_POST['folio'];
        $libro = $_POST['libro'];
        $idfeligres = $_POST['idfeligres'];
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
                                    El registro ya existe
                                </div>';
        } else {
            $query_insert = mysqli_query($conexion, "INSERT INTO bautismo(cui,partida,folio,libro,idfeligres,idmadre,idpadre,idmadrina,idpadrino,idministro,observaciones) values ('$cui', '$partida', '$folio', '$libro', '$idfeligres', '$idmadre', '$idpadre', '$idmadrina', '$idpadrino', '$idministro', '$observaciones')");
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
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ingrese datos para Bautisado</h1>
        <a href="lista_bautismoprueba.php" class="btn btn-primary">Ver listado bautismo</a>
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
                    <label >Nombre del bautizado</label>
                    <select name="idfeligres" id="idfeligres" class="form-control">
                  
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * FROM feligreses");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idfeligres'].'">'.$catec['nombre'].'</option>';
                                        }
                    ?>
                    </select></div>

                    <div class="form-group">
                    <label >Nombre de la madre</label>
                    <select name="idmadre" id="idmadre" class="form-control">
                  
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT feligreses.nombre as nombremadre FROM madre
                      join feligreses ON madre.idfeligres = feligreses.idfeligres ");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idmadre'].'">'.$catec['nombremadre'].'</option>';
                                        }
                    ?>
                    </select></div>

                    <div class="form-group">
                    <label >Nombre del padre </label>
                    <select name="idpadre" id="idpadre" class="form-control">
                  
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT feligreses.nombre as nombrepadre FROM padre
                      join feligreses ON padre.idfeligres = feligreses.idfeligres ");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idpadre'].'">'.$catec['nombrepadre'].'</option>';
                                        }
                    ?>
                    </select></div>

                

                    <div class="form-group">
                    <label >Madrina</label>
                    <select name="idmadrina" id="idmadrina" class="form-control">
                  
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT feligreses.nombre as nombremadrina FROM madrina
                      join feligreses ON madrina.idfeligres = feligreses.idfeligres");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idmadrina'].'">'.$catec['nombremadrina'].'</option>';
                                        }
                    ?>
                    </select></div>

                    <div class="form-group">
                    <label >Padrino</label>
                    <select name="idpadrino" id="idpadrino" class="form-control">
                 
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT feligreses.nombre as nombrepadrino FROM padrino
                      join feligreses ON padrino.idfeligres = feligreses.idfeligres");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idpadrino'].'">'.$catec['nombrepadrino'].'</option>';
                                        }
                    ?>
                    </select></div>

                    <div class="form-group">
                    <label >Ministro</label>
                    <select name="idministro" id="idministro" class="form-control">
                  
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * FROM ministro");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idministro'].'">'.$catec['nombreministro'].'</option>';
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