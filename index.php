<?php include("database.php");?>
<?php include("includes/header.php");?>
<?php 
// Función Encargada de realizar la busqueda por Codigo de Empleado
    if(isset(($_POST["Buscar"]))){

        //Obtenemos el Codigo ingresado en el input
        $CodigoEmpleado = $_POST["BuscarEmpleado"];

        //Si está vacio obtenemos todos los empleados
        if($CodigoEmpleado == "" || $CodigoEmpleado == null){
            $query = "SELECT * FROM empleados";
        }
        else{
            $query = "SELECT * FROM empleados WHERE CODIGOEMPLEADO = '$CodigoEmpleado'";
        }
        
        $resultado = mysqli_query($conn, $query);

        if(!$resultado){
            echo("No se encontró el empleado buscado");
        }
    }
    else{
        //Al iniciar la app se listan todos los empleados
        $query = "SELECT * FROM empleados";
        $resultado = mysqli_query($conn, $query);
    }
?>

<div class="container p-4">
    <div class="row">
        <form action="index.php" method="POST">
            <input type="text" name="BuscarEmpleado" placeholder="Buscar con código" style="padding: 10px; border-radius: 5px 5px 5px 5px; font-size: 16px; width: 60%; height: 80%">
            <button type="submit" style="background-color: #4CAF50; color: white; border: none; border-radius: 5px 5px 5px 5px; cursor: pointer; width: 30%; height: 80%" name="Buscar">Buscar</button>
        </form>
    </div>
</br>
    <div class = "row">
        <div class="col-md-4">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalCrearEmpleado"><i class="fas fa-plus"></i> Crear Empleado</button>
        </div>
    </div>
    <div class="row">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Codigo Empleado</th>
                    <th>Identificacion</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row = mysqli_fetch_array($resultado)){?>
                        <tr>
                            <td><?php echo($row["CODIGOEMPLEADO"]);?></td>
                            <td><?php echo($row["IDENTIFICACION"]);?></td>
                            <td><?php echo($row["NOMBRES"]);?></td>
                            <td><?php echo($row["APELLIDOS"]);?></td>
                            <td><?php echo($row["EMAIL"]);?></td>
                            <td><?php echo($row["TELEFONO"]);?></td>
                            <td>
                                <a href="EditarEmpleado.php?id=<?php echo $row["ID"] ?>" class="btn btn-warning"><i class="fas fa-pen"></i></a>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalEliminarEmpleado" data-value="<?php echo $row["ID"] ?>"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-md-4">
        <?php if(isset($_SESSION['message'])){ ?>
                    <div class="alert alert-<?=$_SESSION['messageType']?> alert-dismissible fade show" role="alert">
                        <?= $_SESSION['message']?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php 
                    session_unset();
                }?>
        </div>
    </div>
</div>

<!-- Modal Para Crear Empleado-->
<div class="modal fade" id="ModalCrearEmpleado" tabindex="-1" role="dialog" aria-labelledby="ModalCrearEmpleadoLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="ModalCrearEmpleadoLabel">Crear Empleado</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
        <div class="col-md-6">
            <div class="card card-body">
                <form action="CrearEmpleado.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="CODIGOEMPLEADO" placeholder ="Codigo Empleado">
                    </div>
                    <div class="form-group">
                        <input type="text" name="IDENTIFICACION" placeholder ="Identificacion">
                    </div>
                    <div class="form-group">
                        <input type="text" name="NOMBRES" placeholder ="Nombres">
                    </div>
                    <div class="form-group">
                        <input type="text" name="APELLIDOS" placeholder ="Apellidos">
                    </div>
                    <div class="form-group">
                        <input type="text" name="EMAIL" placeholder ="Email">
                    </div>
                    <div class="form-group">
                        <input type="text" name="TELEFONO" placeholder ="Telefono">
                    </div>
                    <input type="submit" name="CrearEmpleado" value="Crear Empleado" class="btn btn-success btn-block">
                </form>
            </div>
        </div>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal para eliminar empleado -->
<div class="modal fade" id="ModalEliminarEmpleado" tabindex="-1" role="dialog" aria-labelledby="ModalEliminarEmpleadoLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title" id="ModalEliminarEmpleadoLabel">Eliminar Empleado</h4>
	      </div>
          <form action="EliminarEmpleado.php" method="POST">
	        <div class="modal-body">
                <p>Está seguro que desea eliminar el empleado?</p>
                <div class="form-group">
                        <input type="text" name="TextId" hidden = true>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="submit" name="BorrarEmpleado" value="Eliminar" class="btn btn-danger btn-block">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
          </form>     
	    </div>
    </div>
</div>

<script>
    console.log('click');
		$('#ModalEliminarEmpleado').on('show.bs.modal', function (event) {
            debugger;
			var button = $(event.relatedTarget);
			var id = button.data('value');
            console.log(id);
			var modal = $(this);
			var infoText = document.getElementsByName("TextId")[0];
			infoText.value =id;
		});
	</script>

<?php include("includes/footer.php") ?>