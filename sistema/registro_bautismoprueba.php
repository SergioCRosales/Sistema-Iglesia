<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['idfeligres'])) {
        $alert = '<div class="alert alert-danger" role="alert">
                                    Todo los campos son obligatorio
                                </div>';
    } else {
    
    
        $partida = $_POST['partida'];
        $folio = $_POST['folio'];
        $libro = $_POST['libro'];
        $fecha = $_POST['fecha'];
        $idfeligres = $_POST['idfeligres'];
        $idmadre = $_POST['idmadre'];
        $idpadre = $_POST['idpadre'];
        $idmadrina = $_POST['idmadrina'];
        $idpadrino = $_POST['idpadrino'];
        $idministro = $_POST['idministro'];
        $observaciones = $_POST['observaciones'];
        $orden = $_POST['orden'];

        $usuario_id = $_SESSION['idUser'];

        $result = 0;
        if (is_numeric($idfeligres) and $idfeligres != 0) {
            $query = mysqli_query($conexion, "SELECT * FROM bautismo where idfeligres = '$idfeligres'");
            $result = mysqli_fetch_array($query);
        }
        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                                    El registro ya existe
                                </div>';

         ?> <a target='_blank' href="cita_bautismo.php?id=<?php echo $result['idbautismo']; ?>">
          <div align="center"> <img height="110" width="115" src="img/imprimir.jpg"><h4>Imprimir</h4> </div></a> <?php 


        } else {
          
            $query_insert = mysqli_query($conexion, "INSERT INTO bautismo(partida,folio,libro,fecha,idfeligres,idmadre,idpadre,idmadrina,idpadrino,idministro,observaciones,orden) values ('$partida', '$folio', '$libro', '$fecha', '$idfeligres', '$idmadre', '$idpadre', '$idmadrina', '$idpadrino', '$idministro', '$observaciones','$orden')");
            
            if ($query_insert) {
                $alert = '<div class="alert alert-primary" role="alert">
                                    Registro guardado!
                                </div>';

                                $result2 = 0;
                                if (is_numeric($idfeligres) and $idfeligres != 0) {
                                    $query2 = mysqli_query($conexion, "SELECT * FROM bautismo where idfeligres = '$idfeligres'");
                                    $result2 = mysqli_fetch_array($query2);
                                }

                                ?> <a target='_blank' href="cita_bautismo.php?id=<?php echo $result2['idbautismo']; ?>">
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
        <h1 class="h4 mb-0 text-gray-800">Ingrese datos para constancia Bautismo</h1>
        <a href="lista_bautismoprueba.php" class="btn btn-primary">Ver listado bautismo</a>
    </div>


    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
            <form action="" method="post" autocomplete="off">
                <?php echo isset($alert) ? $alert : ''; ?>
               
                <div class="form-group">
                    <label for="partida">No. Partida</label>
                    <input type="number" placeholder="Ingrese numero de partida" name="partida" id="partida" class="form-control"  required pattern="^[0-9]{10}$">
                </div>
                <div class="form-group">
                    <label for="folio">No. Folio</label>
                    <input type="number" placeholder="Ingrese numero de folio" name="folio" id="folio" class="form-control"  required pattern="^[0-9]{10}$">
                </div>
                <div class="form-group">
                    <label for="libro">No. Libro</label>
                    <input type="number" placeholder="Ingrese numero de libro" name="libro" id="libro" class="form-control"  required pattern="^[0-9]{10}$">
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha del bautismo</label>
                    <input type="date" placeholder="Ingrese fecha nacimiento del bautizado" name="fecha" id="fecha" class="form-control"  required pattern="">
                </div>
                <div class="form-group">
                    <label >Nombre del bautizado</label>
                    <select name="idfeligres" id="Buscador" class="form-control">
                  
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * FROM feligreses");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idfeligres'].'">'.$catec['nombre'].' || '.$catec['cui'].'</option>';
                                        }
                    ?>
                    </select></div>
                    <Script>
                    $('#Buscador').select2();
                    </Script>
                    <div class="form-group">
                    <label >Nombre de la madre</label>
                    <select name="idmadre" id="Buscador2" class="form-control">
                  
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT madre.idmadre as idmadre, feligreses.nombre as nombremadre, feligreses.cui as cui FROM madre
                      join feligreses ON madre.idfeligres = feligreses.idfeligres ");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idmadre'].'">'.$catec['nombremadre'].' || '.$catec['cui'].'</option>';
                                        }
                    ?>
                    </select></div>
                    <Script>
                    $('#Buscador2').select2();
                    </Script>
                    <div class="form-group">
                    <label >Nombre del padre </label>
                    <select name="idpadre" id="Buscador3" class="form-control">
                  
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT padre.idpadre as idpadre, feligreses.nombre as nombrepadre, feligreses.cui as cui FROM padre
                      join feligreses ON padre.idfeligres = feligreses.idfeligres ");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idpadre'].'">'.$catec['nombrepadre'].' || '.$catec['cui'].'</option>';
                                        }
                    ?>
                    </select></div>
                    <Script>
                    $('#Buscador3').select2();
                    </Script>
                    <div class="form-group">
                    <label >Madrina</label>
                    <select name="idmadrina" id="Buscador4" class="form-control">
                  
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT madrina.idmadrina as idmadrina, feligreses.nombre as nombremadrina, feligreses.cui as cui FROM madrina
                      join feligreses ON madrina.idfeligres = feligreses.idfeligres");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idmadrina'].'">'.$catec['nombremadrina'].' || '.$catec['cui'].'</option>';
                                        }
                    ?>
                    </select></div>
                    <Script>
                    $('#Buscador4').select2();
                    </Script>
                    <div class="form-group">
                    <label >Padrino</label>
                    <select name="idpadrino" id="Buscador5" class="form-control">
                 
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT padrino.idpadrino as idpadrino, feligreses.nombre as nombrepadrino, feligreses.cui as cui FROM padrino
                      join feligreses ON padrino.idfeligres = feligreses.idfeligres");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idpadrino'].'">'.$catec['nombrepadrino'].' || '.$catec['cui'].'</option>';
                                        }
                    ?>
                    </select></div>
                    <Script>
                    $('#Buscador5').select2();
                    </Script>
                    <div class="form-group">
                    <label >Ministro</label>
                    <select name="idministro" id="Buscador6" class="form-control">
                  
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * FROM ministro");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idministro'].'">'.$catec['nombreministro'].'</option>';
                                        }
                    ?>
                    </select></div>
                    <Script>
                    $('#Buscador6').select2();
                    </Script>
                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <input type="text" placeholder="Ingrese observaciones" name="observaciones" id="observaciones" class="form-control">
                </div>
                <div class="form-group">
                    <label for="orden">Orden del dia</label>
                    <input type="number" placeholder="Ingrese orden del dia" name="orden" id="orden" class="form-control">
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