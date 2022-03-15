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
        } else {
            $query_insert = mysqli_query($conexion, "INSERT INTO feligreses(cui,nombre,fechanacimiento,iddepartamento,idmunicipio,idlugar,idconfiguracion) values ('$cui', '$nombre', '$fechanacimiento', '$iddepartamento', '$idmunicipio', '$idlugar', '1')");
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
                    <input type="text" placeholder="Ingrese nombre de la feligreses" name="nombre" id="nombre" class="form-control"
                    required pattern="^([A-ZÁÄÉËÍÏÓÖÚÜÑ]{1}[a-záäéëíïóöúüñ]+[ ]?){3,8}$"
                    title="El nombre solo debe contener letras y debe de estar completo"
                    >
                    
                
                </div>
                <div class="form-group">
                    <label for="fechanacimiento">Fecha nacimiento</label>
                    <input type="date" placeholder="Ingrese fecha nacimiento del bautizado" name="fechanacimiento" id="fecha_nacimiento" class="form-control">
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

         


                <input type="submit" value="Guardar registro feligreses" class="btn btn-primary">
            </form>
        </div>
    </div>


    


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include_once "includes/footer.php"; ?>


