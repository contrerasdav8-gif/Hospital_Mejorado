<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
}

include("../Config/conexion.php");

$id = $_GET['id'];

// ACTUALIZAR
if(isset($_POST['actualizar'])){

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $edad = $_POST['edad'];
    $sexo = $_POST['sexo'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];

    $sql = "UPDATE pacientes SET
            nombre='$nombre',
            apellido='$apellido',
            edad='$edad',
            sexo='$sexo',
            telefono='$telefono',
            direccion='$direccion',
            correo='$correo'
            WHERE id='$id'";

    if(mysqli_query($conexion,$sql)){
        header("Location: pacientes.php");
        exit();
    }else{
        echo "Error al actualizar";
    }

}

// OBTENER DATOS
$sql = "SELECT * FROM pacientes WHERE id='$id'";
$resultado = mysqli_query($conexion,$sql);
$fila = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Editar Paciente</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f6f9;
}

.card{
    width:700px;
    margin:40px auto;
    box-shadow:0px 0px 15px rgba(0,0,0,.2);
    border:none;
}

</style>

</head>

<body>

<div class="card p-4">

<h2>Editar Paciente</h2>

<hr>

<form method="POST">

<div class="mb-3">
<label>Nombre</label>
<input type="text" name="nombre" class="form-control"
value="<?php echo $fila['nombre']; ?>" required>
</div>

<div class="mb-3">
<label>Apellido</label>
<input type="text" name="apellido" class="form-control"
value="<?php echo $fila['apellido']; ?>" required>
</div>

<div class="mb-3">
<label>Edad</label>
<input type="number" name="edad" class="form-control"
value="<?php echo $fila['edad']; ?>">
</div>

<div class="mb-3">
<label>Sexo</label>

<select name="sexo" class="form-control">

<option <?php if($fila['sexo']=="Masculino") echo "selected"; ?>>
Masculino
</option>

<option <?php if($fila['sexo']=="Femenino") echo "selected"; ?>>
Femenino
</option>

</select>

</div>

<div class="mb-3">
<label>Teléfono</label>
<input type="text" name="telefono" class="form-control"
value="<?php echo $fila['telefono']; ?>">
</div>

<div class="mb-3">
<label>Dirección</label>
<input type="text" name="direccion" class="form-control"
value="<?php echo $fila['direccion']; ?>">
</div>

<div class="mb-3">
<label>Correo</label>
<input type="email" name="correo" class="form-control"
value="<?php echo $fila['correo']; ?>">
</div>

<button type="submit" name="actualizar" class="btn btn-success">
Guardar Cambios
</button>

<a href="pacientes.php" class="btn btn-secondary">
Cancelar
</a>

</form>

</div>

</body>

</html>