<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['idbautismo'])) {
        $alert = '<div class="alert alert-danger" role="alert">
                                    Todo los campos son obligatorio
                                </div>';
    } else {
    
        
        $partida = $_POST['partida'];
        $folio = $_POST['folio'];
        $libro = $_POST['libro'];
        $fecha = $_POST['fecha'];
        $idtestiga = $_POST['idtestiga'];
        $idtestigo = $_POST['idtestigo'];
        $idfeligres = $_POST['idfeligres'];
        $edadesposo = $_POST['edadesposo'];
        $idpadre = $_POST['idpadre'];
        $idmadre = $_POST['idmadre'];
        $idbautismo = $_POST['idbautismo'];
        $edadesposa = $_POST['edadesposa'];
        $idministro = $_POST['idministro'];
        $observaciones = $_POST['observaciones'];

        $usuario_id = $_SESSION['idUser'];

        $result = 0;
        if (is_numeric($idtestiga) and $idtestiga != 0) {
            $query = mysqli_query($conexion, "SELECT * FROM matrimoniocombm where idbautismo = '$idbautismo'");
            $result = mysqli_fetch_array($query);
        }
        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                                    El registro ya existe
                                </div>';

                                ?> <a target='_blank' href="constancia_matrimoniom.php?id=<?php echo $result['idmatrimonio']; ?>">
                                <div align="center"> <img height="110" width="115" src="img/imprimir.jpg"><h4>Imprimir</h4> </div></a> <?php 
        } else {
            $query_insert = mysqli_query($conexion, "INSERT INTO matrimoniocombm(partida,folio,libro,fecha,idtestiga,idtestigo,idfeligres,edadesposo,idpadre,idmadre,idbautismo,edadesposa,idministro,observaciones) values ('$partida', '$folio', '$libro', '$fecha', '$idtestiga', '$idtestigo', '$idfeligres', '$edadesposo', '$idpadre', '$idmadre', '$idbautismo', '$edadesposa', '$idministro', '$observaciones')");
            if ($query_insert) {
                $alert = '<div class="alert alert-primary" role="alert">
                                    Registro guardado!
                                </div>';

                                $result2 = 0;
                                if (is_numeric($idtestiga) and $idtestiga != 0) {
                                    $query2 = mysqli_query($conexion, "SELECT * FROM matrimoniocombm where idbautismo = '$idbautismo'");
                                    $result2 = mysqli_fetch_array($query2);
                                }

                                ?> <a target='_blank' href="constancia_matrimoniom.php?id=<?php echo $result2['idmatrimonio']; ?>">
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
        <h1 class="h4 mb-0 text-gray-800">Ingrese datos para registro de Matrimonio <br> esposa (de esta parroquia) y esposo (de otra parroquia)</h1>
        <a href="lista_matrimonio.php" class="btn btn-primary">Ver listado matrimonio</a>
    </div>
    <br>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="registro_matrimoniomixtoh.php" class="btn btn-primary">Esposa de otra parroquia</a>
    
    </div>


    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
            <form action="" method="post" autocomplete="off">
                <?php echo isset($alert) ? $alert : ''; ?>
               
                <div class="form-group">
                    <label for="partida">No. Partida</label>
                    <input type="number" placeholder="Ingrese numero de partida" name="partida" id="partida" required pattern="^[0-9]{10}$" class="form-control">
                </div>
                <div class="form-group">
                    <label for="folio">No. Folio</label>
                    <input type="number" placeholder="Ingrese numero de folio" name="folio" id="folio" required pattern="^[0-9]{10}$"  class="form-control">
                </div>
                <div class="form-group">
                    <label for="libro">No. Libro</label>
                    <input type="number" placeholder="Ingrese numero de libro" name="libro" id="libro" required pattern="^[0-9]{10}$" class="form-control">
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha en que se recibe el sacramento</label>
                    <input type="date" placeholder="Ingrese fecha del matrimonio" name="fecha" id="fecha" required pattern=""  class="form-control">
                </div>

                    
                <div class="form-group">
                    <label >Nombre de la testigo</label>
                    <select name="idtestiga" id="Buscador" class="form-control">
                    
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT testiga.idtestiga as idtestiga, feligreses.nombre as nombretestiga, feligreses.cui as cui FROM testiga
                      join feligreses ON testiga.idfeligres = feligreses.idfeligres");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idtestiga'].'">'.$catec['nombretestiga'].' || '.$catec['cui'].'</option>';
                                        }
                    ?>
                    </select></div>
                    <Script>
                    $('#Buscador').select2();
                    </Script>

                   
                    <div class="form-group">
                    <label >Nombre del testigo</label>
                    <select name="idtestigo" id="Buscador2" class="form-control">
                  
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT testigoep.idtestigo as idtestigo, feligresesep.nombre as nombretestigo, feligresesep.cui as cui FROM testigoep
                      join feligresesep ON testigoep.idfeligreses = feligresesep.idfeligres");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idtestigo'].'">'.$catec['nombretestigo'].' || '.$catec['cui'].'</option>';
                                        }
                    ?>
                    </select></div>
                    <Script>
                    $('#Buscador2').select2();
                    </Script>

                    <div class="form-group">
                    <label >Nombre del esposo</label>
                    <select name="idfeligres" id="Buscador3" class="form-control">
                 
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * from feligresesep");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idfeligres'].'">'.$catec['nombre'].' || '.$catec['cui'].'</option>';
                                        }
                    ?>
                    </select></div>
                    <Script>
                    $('#Buscador3').select2();
                    </Script>

                    <div class="form-group">
                       <label for="edadesposo">Edad del esposo</label>
                       <input type="number" placeholder="Ingrese edad del esposo" name="edadesposo" id="edadesposo" class="form-control"
                       required pattern="^[1-9]{1}[0-9]{2}$" 
                       title="Verifique la edad">
                    </div>

                    <div class="form-group">
                    <label >Nombre del padre (esposo)</label>
                    <select name="idpadre" id="Buscador4" class="form-control">
                  
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT padreep.idpadre as idpadre, feligresesep.nombre as nombrepadre, feligresesep.cui as cui FROM padreep
                      join feligresesep ON padreep.idfeligreses = feligresesep.idfeligres ");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idpadre'].'">'.$catec['nombrepadre'].' || '.$catec['cui'].'</option>';
                                        }
                    ?>
                    </select></div>
                    <Script>
                    $('#Buscador4').select2();
                    </Script>

                    <div class="form-group">
                    <label >Nombre de la madre (esposo)</label>
                    <select name="idmadre" id="Buscador5" class="form-control">
                  
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT madreep.idmadre as idmadre, feligresesep.nombre as nombremadre, feligresesep.cui as cui FROM madreep
                      join feligresesep ON madreep.idfeligreses = feligresesep.idfeligres ");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idmadre'].'">'.$catec['nombremadre'].' || '.$catec['cui'].'</option>';
                                        }
                    ?>
                    </select></div>
                    <Script>
                    $('#Buscador5').select2();
                    </Script>

                    <div class="form-group">
                    <label >Nombre de la esposa</label>
                    <select name="idbautismo" id="Buscador6" class="form-control">
                 
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT bautismo.idbautismo as idbautismo, feligreses.nombre as nombre, feligreses.cui as cui FROM bautismo 
                      join feligreses on bautismo.idfeligres = feligreses.idfeligres");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idbautismo'].'">'.$catec['nombre'].' || '.$catec['cui'].'</option>';
                                        }
                    ?>
                    </select></div>
                    <Script>
                    $('#Buscador6').select2();
                    </Script>

                    
                    <div class="form-group">
                       <label for="edadesposa">Edad del la esposa</label>
                       <input type="number" placeholder="Ingrese edad de la esposa" name="edadesposa" id="edadesposa" class="form-control"
                       required pattern="^[1-9]{1}[0-9]{2}$" 
                       title="Verifique la edad">
                    </div>

                   

                    <div class="form-group">
                    <label >Nombre ministro</label>
                    <select name="idministro" id="Buscador7" class="form-control">
                  
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * FROM ministro");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idministro'].'">'.$catec['nombreministro'].'</option>';
                                        }
                    ?>
                    </select></div>
                    <Script>
                    $('#Buscador7').select2();
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