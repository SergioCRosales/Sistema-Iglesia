<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['idbautismo'])) {
        $alert = '<div class="alert alert-danger" role="alert">
                                    Todo los campos son obligatorio
                                </div>';
    } else {
    
        
        $partidacm = $_POST['partidacm'];
        $foliocm = $_POST['foliocm'];
        $librocm = $_POST['librocm'];
        $fecha = $_POST['fecha'];
        $idbautismo = $_POST['idbautismo'];
        $idmadrina = $_POST['idmadrina'];
        $idpadrino = $_POST['idpadrino'];
        $idministro = $_POST['idministro'];
        $observaciones = $_POST['observaciones'];

        $usuario_id = $_SESSION['idUser'];

        $result = 0;
        if (is_numeric($idbautismo) and $idbautismo != 0) {
            $query = mysqli_query($conexion, "SELECT * FROM comunion where idbautismo = '$idbautismo'");
            $result = mysqli_fetch_array($query);
        }
        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                                    El registro ya existe
                                </div>';

                                ?> <a target='_blank' href="constancia_comunion.php?id=<?php echo $result['idcomunion']; ?>">
                                <div align="center"> <img height="110" width="115" src="img/imprimir.jpg"><h4>Imprimir</h4> </div></a> <?php 
        } else {
            $query_insert = mysqli_query($conexion, "INSERT INTO comunion(partidacm,foliocm,librocm,fecha,idbautismo,idmadrina,idpadrino,idministro,observaciones) values ('$partidacm', '$foliocm', '$librocm', '$fecha', '$idbautismo', '$idmadrina', '$idpadrino', '$idministro', '$observaciones')");
            if ($query_insert) {
                $alert = '<div class="alert alert-primary" role="alert">
                                    Registro guardado!
                                </div>';

                                $result2 = 0;
                                if (is_numeric($idbautismo) and $idbautismo != 0) {
                                    $query2 = mysqli_query($conexion, "SELECT * FROM comunion where idbautismo = '$idbautismo'");
                                    $result2 = mysqli_fetch_array($query2);
                                }

                                ?> <a target='_blank' href="constancia_comunion.php?id=<?php echo $result2['idcomunion']; ?>">
                                <div align="center"> <img height="110" width="115" src="img/imprimir.jpg"><h4>Imprimir</h4> </div></a> <?php


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
        <h1 class="h4 mb-0 text-gray-800">Ingrese datos para constancia de Primera Comunion</h1>
        <a href="lista_primeracomunion.php" class="btn btn-primary">Ver listado comunion</a>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="registro_primeracomunionep.php" class="btn btn-primary">Originario de otra parroquia</a>
    
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
            <form action="" method="post" autocomplete="off">
                <?php echo isset($alert) ? $alert : ''; ?>
               
                <div class="form-group">
                    <label for="partidacm">No. Partida</label>
                    <input type="number" placeholder="Ingrese numero de partida" name="partidacm" id="partidacm" class="form-control"  required pattern="^[0-9]{10}$">
                </div>
                <div class="form-group">
                    <label for="foliocm">No. Folio</label>
                    <input type="number" placeholder="Ingrese numero de folio" name="foliocm" id="foliocm" class="form-control"  required pattern="^[0-9]{10}$">
                </div>
                <div class="form-group">
                    <label for="librocm">No. Libro</label>
                    <input type="number" placeholder="Ingrese numero de libro" name="librocm" id="librocm" class="form-control"  required pattern="^[0-9]{10}$">
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha para la primera comunion</label>
                    <input type="date" placeholder="Ingrese fecha en que se recibe el sacramento" name="fecha" id="fecha" class="form-control"  required pattern="">
                </div>


                <div class="form-group">
                    <label >Nombre</label>
                    <select name="idbautismo" id="Buscador" class="form-control">
                    
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT bautismo.idbautismo as idbautismo, feligreses.nombre as nombre, feligreses.cui as cui FROM bautismo 
                      join feligreses on bautismo.idfeligres = feligreses.idfeligres ");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idbautismo'].'">'.$catec['nombre'].' || '.$catec['cui'].'</option>';
                                        }
                    ?>
                    </select></div>
                    <Script>
                    $('#Buscador').select2();
                    </Script>

                    <div class="form-group">
                    <label >Madrina</label>
                    <select name="idmadrina" id="Buscador2" class="form-control">
                  
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT madrina.idmadrina as idmadrina, feligreses.nombre as nombremadrina, feligreses.cui as cui FROM madrina
                      join feligreses ON madrina.idfeligres = feligreses.idfeligres");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idmadrina'].'">'.$catec['nombremadrina'].' || '.$catec['cui'].'</option>';
                                        }
                    ?>
                    </select></div>
                    <Script>
                    $('#Buscador2').select2();
                    </Script>

                    <div class="form-group">
                    <label >Padrino</label>
                    <select name="idpadrino" id="Buscador3" class="form-control">
                 
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT padrino.idpadrino as idpadrino, feligreses.nombre as nombrepadrino, feligreses.cui as cui FROM padrino
                      join feligreses ON padrino.idfeligres = feligreses.idfeligres");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idpadrino'].'">'.$catec['nombrepadrino'].' || '.$catec['cui'].'</option>';
                                        }
                    ?>
                    </select></div>
                    <Script>
                    $('#Buscador3').select2();
                    </Script>

                    <div class="form-group">
                    <label >Ministro</label>
                    <select name="idministro" id="Buscador4" class="form-control">
                  
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * FROM ministro");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idministro'].'">'.$catec['nombreministro'].'</option>';
                                        }
                    ?>
                    </select></div>
                    <Script>
                    $('#Buscador4').select2();
                    </Script>

    
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