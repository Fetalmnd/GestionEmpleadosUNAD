<?php
    include ("database.php");

    if(isset($_POST["BorrarEmpleado"])){
        echo("Eliminando...");
        $IdEliminar = $_POST["TextId"];
        $query = "DELETE FROM empleados WHERE ID = '$IdEliminar'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            $_SESSION['message'] = 'No se pudo eliminar el registro';
            $_SESSION['messageType'] = "danger";
        }
        else{
            $_SESSION['message'] = 'Se ha eliminado el registro correctamente';
            $_SESSION['messageType'] = "success";
        }

        header("Location: index.php");
    }

?>