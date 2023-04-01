<?php
include("database.php");

if(isset($_POST["CrearEmpleado"])){
    $CodigoEmpleado = $_POST["CODIGOEMPLEADO"];
    $Identificacion = $_POST["IDENTIFICACION"];
    $Nombres = $_POST["NOMBRES"];
    $Apellidos = $_POST["APELLIDOS"];
    $Email = $_POST["EMAIL"];
    $Telefono = $_POST["TELEFONO"];


    $query = "INSERT INTO empleados(CODIGOEMPLEADO, IDENTIFICACION, NOMBRES, APELLIDOS, EMAIL, TELEFONO) VALUES ('$CodigoEmpleado','$Identificacion','$Nombres','$Apellidos','$Email','$Telefono') ";
             
    $result = mysqli_query($conn, $query);

    if(!$result){
        echo("No se pudo guardar");
    }

    $_SESSION['message'] = "Se creo el empleado correctamente";
    $_SESSION['messageType'] = "success";

    header("Location: index.php");

}
?>