<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
   
   
    if (empty($_POST['nombre']))  {
        $alert = '<div class="alert alert-danger" role="alert">
                                    Debe ingresar nombre del feligres
                                </div>';

                                                  

    } else {

      

        $cui = $_POST['cui'];
        
        $nombre = $_POST['nombre'];
        $fechanacimiento = $_POST['fechanacimiento'];
        $iddepartamento = $_POST['iddepartamento'];
        $idmunicipio = $_POST['idmunicipio'];
        $idlugar = $_POST['idlugar'];
      

        if(empty( $_POST['opcion1'])){
            $opcion1 = 0;
        }else{
            $opcion1 = $_POST['opcion1'];
        }

        if(empty( $_POST['opcion2'])){
            $opcion2 = 0;
        }else{
            $opcion2 = $_POST['opcion2'];
        }

        if(empty( $_POST['opcion3'])){
            $opcion3 = 0;
        }else{
            $opcion3 = $_POST['opcion3'];
        }

        if(empty( $_POST['opcion4'])){
            $opcion4 = 0;
        }else{
            $opcion4 = $_POST['opcion4'];
        }

        if(empty( $_POST['opcion5'])){
            $opcion5 = 0;
        }else{
            $opcion5 = $_POST['opcion5'];
        }

        if(empty( $_POST['opcion6'])){
            $opcion6 = 0;
        }else{
            $opcion6 = $_POST['opcion6'];
        }

       

    
        $usuario_id = $_SESSION['idUser'];

       
       
        
        $result = 0;
        if (is_numeric($cui) and $cui != 0) {
            $query = mysqli_query($conexion, "SELECT * FROM feligreses where cui = '$cui'");
            $result = mysqli_fetch_array($query);
        }
        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                                    El CUI ya habia sido registrado
                                </div>';

                                ?> <a href="editar_feligreses.php?id=<?php echo $result['idfeligres']; ?>">
                                <div align="center"> <img height="110" width="115" src="img/editar.jpg"><h4>Ver o editar <br> registro</h4> </div></a> <?php 



        } else {
            $query_insert = mysqli_query($conexion, "INSERT INTO feligreses(cui,nombre,fechanacimiento,iddepartamento,idmunicipio,idlugar,idconfiguracion) values ('$cui', '$nombre', '$fechanacimiento', '$iddepartamento', '$idmunicipio', '$idlugar', '1')");
            if ($query_insert) {
                $alert = '<div class="alert alert-primary" role="alert">
                                    Registro guardado!
                                </div>';

                $id_insertado = mysqli_insert_id($conexion);

                                if($opcion1 === '1'){
                                    $query_insert1 = mysqli_query($conexion, "INSERT INTO madre(idfeligres) values ('$id_insertado')");
                                }else{

                                }

                                if($opcion2 === '2'){
                                    $query_insert2 = mysqli_query($conexion, "INSERT INTO padre(idfeligres) values ('$id_insertado')");
                                }else{

                                }

                                if($opcion3 === '3'){
                                    $query_insert3 = mysqli_query($conexion, "INSERT INTO madrina(idfeligres) values ('$id_insertado')");
                                }else{

                                }

                                if($opcion4 === '4'){
                                    $query_insert4 = mysqli_query($conexion, "INSERT INTO padrino(idfeligres) values ('$id_insertado')");
                                }else{

                                }

                                if($opcion5 === '5'){
                                    $query_insert5 = mysqli_query($conexion, "INSERT INTO testiga(idfeligres) values ('$id_insertado')");
                                }else{

                                }

                                if($opcion6 === '6'){
                                    $query_insert5 = mysqli_query($conexion, "INSERT INTO testigo(idfeligres) values ('$id_insertado')");
                                }else{

                                }
                                        

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
        <h1 class="h3 mb-0 text-gray-800">Ingrese datos del feligres</h1>
        <a href="registro_bautismoprueba.php" class="btn btn-primary">Registrar bautismo</a>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="registro_feligresesep.php" class="btn btn-primary">Originario de otra parroquia</a>
    
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
            <form action="" method="post" autocomplete="on">
                <?php echo isset($alert) ? $alert : ''; ?>
            
                <div class="form-group">
                    <label for="cui">CUI</label>
                    <input type="text" placeholder="Ingrese numero CUI" name="cui" id="cui" class="form-control" maxlength="13"
                    pattern="^[1-9]{1}[0-9]{12}$"
                    title="Verifique el CUI si esta completo o bien ingresado"
                    >
                </div>
                <div class="form-group">
                    <label for="nombre">Ingrese nombres y apellidos del feligres</label>
                    <input type="text" placeholder="Ingrese nombre feligres" name="nombre" id="nombre" class="form-control"
                    required pattern="^([A-ZÁÄÉËÍÏÓÖÚÜÑ]{1}[a-záäéëíïóöúüñ]+[ ]?){2,8}$"
                    title="El nombre solo debe contener letras y debe de estar completo"
                    >
                    
                
                </div>

                <div>
                <span>Elija rol (si aplica)</span>
                <br>
                <label><input type="checkbox" value=1 name="opcion1" />Madre</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <label><input type="checkbox" value=2 name="opcion2" />Padre</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <label><input type="checkbox" value=3 name="opcion3" />Madrina</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <label><input type="checkbox" value=4 name="opcion4" />Padrino</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <label><input type="checkbox" value=5 name="opcion5" />Testiga</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <label><input type="checkbox" value=6 name="opcion6" />Testigo</label>
                </div>


                <div class="form-group">
                    <label for="fechanacimiento">Fecha nacimiento</label>
                    <input type="date" placeholder="Ingrese fecha nacimiento del bautizado" name="fechanacimiento" id="fecha_nacimiento" class="form-control"  required pattern="">
                </div>

                <div class="form-group">
                    <label >Departamento</label>
                    <select id="Buscador" name="iddepartamento"  class="form-control">
                   
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * FROM departamento");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['iddepartamento'].'">'.$catec['nombredepartamento'].'</option>';
                                        }
                    ?>
                    </select></div>
                    <Script>
                    $('#Buscador').select2();
                    </Script>

    
                    <div class="form-group">
                    <label >Municipio</label>
                    <select id="Buscador2" name="idmunicipio"  class="form-control">
                    
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * FROM municipio");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idmunicipio'].'">'.$catec['nombremunicipio'].'</option>';
                                        }
                    ?>
                    </select></div>
                    <Script>
                    $('#Buscador2').select2();
                    </Script>


                <div class="form-group">
                    <label >Lugar</label>
                    <select  id="Buscador3" name="idlugar" class="form-control">
                    
                    <?php 
                    
                      $categoriac= mysqli_query($conexion, "SELECT * FROM lugar");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idlugar'].'">'.$catec['nombrelugar'].'</option>';
                                        }
                    ?>
                    </select></div>

                    <Script>
                    $('#Buscador3').select2();
                    </Script>

         


                <input type="submit" value="Guardar registro feligres" class="btn btn-primary">
            </form>
        </div>
    </div>


    


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include_once "includes/footer.php"; ?>


