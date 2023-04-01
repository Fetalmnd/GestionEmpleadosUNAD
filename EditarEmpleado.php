<!-- Andres Morcillo-->
<?php
 include ("database.php");
if (isset($_GET['id'])){
 
    $id = $_GET['id'];
    $query = "SELECT * FROM empleados WHERE ID = '$id'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $CodigoEmpleado = $row ['CODIGOEMPLEADO'];   
        $Identificacion = $row ['IDENTIFICACION'];
        $Nombres = $row ['NOMBRES'];
        $Apellidos = $row ['APELLIDOS'];
        $Email = $row ['EMAIL'];
        $Telefono = $row ['TELEFONO'];
    }
}


if (isset($_POST['Update'])){
   $id = $_GET['id'];
   $CodigoEmpleado = $_POST['CODIGOEMPLEADO'];
   $Identificacion = $_POST['IDENTIFICACION'];
   $Nombres = $_POST['NOMBRES'];
   $Apellidos = $_POST['APELLIDOS'];
   $Email = $_POST['EMAIL'];
   $Telefono = $_POST['TELEFONO'];

   $query = "Update empleados set CodigoEmpleado = '$CodigoEmpleado', Identificacion = '$Identificacion', Nombres = '$Nombres',
    Apellidos = '$Apellidos', Email = '$Email', Telefono = '$Telefono' WHERE ID = '$id'";
    mysqli_query($conn, $query);

    $_SESSION['message'] = 'Se ha actualizado correctamente el registro';
    $_SESSION['messageType'] = "warning";
    header("Location: index.php");


}


?>
<? php include ("includes/header.php")?>

<div class="container p-6">
     <div class="row">
        <div class="col-md-6 mx-auto">
         <div class="card card-body">
            <form action="EditarEmpleado.php?id=<?php echo $_GET['id']; ?>" method="POST" >
                <div class="form-group">
                    <input type="text" name="CODIGOEMPLEADO" placeholder ="Codigo Empleado" value = "<?php echo($CodigoEmpleado);?>">
                </div>
                <div class="form-group">
                    <input type="text" name="IDENTIFICACION" placeholder ="Identificacion" value = "<?php echo($Identificacion);?>">
                </div>
                <div class="form-group">
                    <input type="text" name="NOMBRES" placeholder ="Nombres" value = "<?php echo($Nombres);?>">
                </div>
                <div class="form-group">
                    <input type="text" name="APELLIDOS" placeholder ="Apellidos" value = "<?php echo($Apellidos);?>">
                </div>
                <div class="form-group">
                    <input type="text" name="EMAIL" placeholder ="Email" value = "<?php echo($Email);?>">
                </div>
                <div class="form-group">
                    <input type="text" name="TELEFONO" placeholder ="Telefono" value = "<?php echo($Telefono);?>">
                </div></textarea>
            </div>
            <button class= "btn btn-success"  name= "Update">
              Update
            </button>
            </form>
         </div>
        </div>
     </div>
</div>


<? php include ("includes/footer.php")?>