<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
    $alert = "";
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
        $idparroquia = $_POST['idparroquia'];

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
        $sql = "select * from feligresesep where cui='$cui'";
        $result = mysqli_query($conexion, $sql);

        if(mysqli_num_rows($result)>0 and $cui != 0)
        { 

            $alert = '<div class="alert alert-danger" role="alert">
                                    El CUI ya habia sido registrado
                                </div>';


        } else {
            $query_insert = mysqli_query($conexion, "INSERT INTO feligresesep(cui,nombre,fechanacimiento,iddepartamento,idmunicipio,idlugar,idparroquia,idconfiguracion) values ('$cui', '$nombre', '$fechanacimiento', '$iddepartamento', '$idmunicipio', '$idlugar', '$idparroquia', '1')");
            if ($query_insert) {
                $alert = '<div class="alert alert-primary" role="alert">
                                    Registro guardado!
                                </div>';

                                $id_insertado = mysqli_insert_id($conexion);

                                if($opcion1 === '1'){
                                    $query_insert1 = mysqli_query($conexion, "INSERT INTO madreep(idfeligreses) values ('$id_insertado')");
                                }else{

                                }

                                if($opcion2 === '2'){
                                    $query_insert2 = mysqli_query($conexion, "INSERT INTO padreep(idfeligreses) values ('$id_insertado')");
                                }else{

                                }

                                if($opcion3 === '3'){
                                    $query_insert3 = mysqli_query($conexion, "INSERT INTO madrinaep(idfeligreses) values ('$id_insertado')");
                                }else{

                                }

                                if($opcion4 === '4'){
                                    $query_insert4 = mysqli_query($conexion, "INSERT INTO padrinoep(idfeligreses) values ('$id_insertado')");
                                }else{

                                }

                                if($opcion5 === '5'){
                                    $query_insert5 = mysqli_query($conexion, "INSERT INTO testigaep(idfeligreses) values ('$id_insertado')");
                                }else{

                                }

                                if($opcion6 === '6'){
                                    $query_insert5 = mysqli_query($conexion, "INSERT INTO testigoep(idfeligreses) values ('$id_insertado')");
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
        <h1 class="h3 mb-0 text-gray-800">Ingrese datos del feligres (Originario de otra parroquia)</h1>
        <a href="registro_bautismoprueba.php" class="btn btn-primary">Registrar bautismo</a>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="registro_feligreses.php" class="btn btn-primary">Originario de esta parroquia</a>
    
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
            <form action="" method="post" autocomplete="off">
                <?php echo isset($alert) ? $alert : ''; ?>
                
                <div class="form-group">
                    <label for="cui">CUI</label>
                    <input type="text" placeholder="Ingrese numero CUI" name="cui" id="cui" class="form-control"  maxlength="13"
                    pattern="^[1-9]{1}[0-9]{12}$"
                    title="Verifique el CUI si esta completo o bien ingresado">
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

                   
                    <div class="form-group">
                    <label >Lugar de origen</label>
                    <select id="Buscador3" name="idlugar" class="form-control">
                    
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * FROM lugar");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idlugar'].'">'.$catec['nombrelugar'].'</option>';
                                        }
                    ?>
                    </select></div>

                    <div class="form-group">
                    <label >Parroquia</label>
                    <select id="Buscador4" name="idparroquia" class="form-control">
                   
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * FROM parroquia");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idparroquia'].'">'.$catec['nombreparroquia'].'</option>';
                                        }
                    ?>
                    </select></div>

                    <Script>
                    $('#Buscador').select2();
                    </Script>

                    <Script>
                    $('#Buscador2').select2();
                    </Script>

                    <Script>
                    $('#Buscador3').select2();
                    </Script>

                    <Script>
                    $('#Buscador4').select2();
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