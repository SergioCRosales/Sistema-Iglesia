<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['idbautismo'])) {
        $alert = '<div class="alert alert-danger" role="alert">
                                    Todo los campos son obligatorio
                                </div>';
    } else {
    
        
        $partidam = $_POST['partidam'];
        $foliom = $_POST['foliom'];
        $librom = $_POST['librom'];
        $idtestiga = $_POST['idtestiga'];
        $idtestigo = $_POST['idtestigo'];
        $idbautismo = $_POST['idbautismo'];
        $edadhombre = $_POST['edadmujer'];
        $idlugar = $_POST['idlugar'];
        $idbautismo2 = $_POST['idbautismo2'];
        $edadmujer = $_POST['edadmujer'];
        $idlugar2 = $_POST['idlugar2'];
        $idministro = $_POST['idministro'];
        $observaciones = $_POST['observaciones'];

        $usuario_id = $_SESSION['idUser'];

        $result = 0;
        if (is_numeric($idbautismo) and $idbautismo != 0) {
            $query = mysqli_query($conexion, "SELECT * FROM matrimonio where idbautismo = '$idbautismo'");
            $result = mysqli_fetch_array($query);
        }
        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                                    El registro ya existe
                                </div>';
        } else {
            $query_insert = mysqli_query($conexion, "INSERT INTO matrimonio(partidam,foliom,librom,idtestida,idtestigo,idbautismo,edadhombre,idlugar,idbautismo2,edadmujer,idlugar2,idministro,observaciones) values ('$partidam', '$foliom', '$librom', '$idtestiga', '$idtestigo', '$idbautismo', '$edadhombre', '$idlugar', '$idbautismo2', '$edadmujer', '$idlugar2', '$idministro', '$observaciones')");
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
        <h1 class="h3 mb-0 text-gray-800">Ingrese datos para Matrimonio</h1>
        <a href="lista_matrimonio.php" class="btn btn-primary">Ver listado matrimonio</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
            <form action="" method="post" autocomplete="off">
                <?php echo isset($alert) ? $alert : ''; ?>
               
                <div class="form-group">
                    <label for="partidam">No. Partida</label>
                    <input type="number" placeholder="Ingrese numero de partidam" name="partidam" id="partidam" class="form-control">
                </div>
                <div class="form-group">
                    <label for="foliom">No. Folio</label>
                    <input type="number" placeholder="Ingrese numero de foliom" name="foliom" id="foliom" class="form-control">
                </div>
                <div class="form-group">
                    <label for="librom">No. Libro</label>
                    <input type="number" placeholder="Ingrese numero de librom" name="librom" id="librom" class="form-control">
                </div>

                              
            

                <div class="form-group">
                    <label >Seleccione testiga</label>
                    <select name="idtestiga" id="idtestiga" class="form-control">
                    
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * FROM testiga");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idtestiga'].'">'.$catec['nombretestiga'].'</option>';
                                        }
                    ?>
                    </select></div>

                    <div class="form-group">
                    <label >Seleccione testigo</label>
                    <select name="idtestigo" id="idtestigo" class="form-control">
                    
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * FROM testigo");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idtestigo'].'">'.$catec['nombretestigo'].'</option>';
                                        }
                    ?>
                    </select></div>

                    <div class="form-group">
                    <label >Seleccione nombre del esposo </label>
                    <select name="idbautismo" id="idbautismo" class="form-control">
                    
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * FROM bautismo");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idbautismo'].'">'.$catec['nombre'].'</option>';
                                        }
                    ?>
                    </select></div>

                    <div class="form-group">
                    <label for="edadhombre">Edad del esposo</label>
                    <input type="number" placeholder="Ingrese edad del esposo" name="edadhombre" id="edadhombre" class="form-control">
                    </div>

                    <div class="form-group">
                    <label >Seleccione lugar esposo </label>
                    <select name="idlugar" id="idlugar" class="form-control">
                    
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * FROM lugar");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idlugar'].'">'.$catec['nombrelugar'].'</option>';
                                        }
                    ?>
                    </select></div>

                    <div class="form-group">
                    <label >Seleccione nombre de la esposa </label>
                    <select name="idbautismo2" id="idbautismo2" class="form-control">
                    
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * FROM bautismo");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idbautismo'].'">'.$catec['nombre'].'</option>';
                                        }
                    ?>
                    </select></div>

                    <div class="form-group">
                    <label for="edadmujer">Edad de la esposa</label>
                    <input type="number" placeholder="Ingrese edad de la esposa" name="edadmujer" id="edadmujer" class="form-control">
                    </div>

                    <div class="form-group">
                    <label >Seleccione lugar de la esposa </label>
                    <select name="idlugar2" id="idlugar2" class="form-control">
                    
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * FROM lugar");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idlugar'].'">'.$catec['nombrelugar'].'</option>';
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