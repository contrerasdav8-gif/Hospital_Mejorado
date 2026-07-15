<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
}

include("../Config/conexion.php");

$id = $_GET['id'];

if(isset($_POST['actualizar'])){

    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $especialidad=$_POST['especialidad'];
    $telefono=$_POST['telefono'];
    $correo=$_POST['correo'];

    $sql="UPDATE doctores SET

    nombre='$nombre',
    apellido='$apellido',
    especialidad='$especialidad',
    telefono='$telefono',
    correo='$correo'

    WHERE id='$id'";

    mysqli_query($conexion,$sql);

    header("Location: doctores.php");
    exit();
}

$sql="SELECT * FROM doctores WHERE id='$id'";
$resultado=mysqli_query($conexion,$sql);
$fila=mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Editar Doctor</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f6f9;
}

.contenedor{
    width:700px;
    margin:40px auto;
}

.card{
    border:none;
    box-shadow:0 0 15px rgba(0,0,0,.15);
}

</style>

</head>

<body>

<div class="contenedor">

<div class="card p-4">

<h2>Editar Doctor</h2>

<hr>

<form method="POST">

<div class="mb-3">
<label>Nombre</label>
<input type="text" name="nombre" class="form-control"
value="<?php echo $fila['nombre']; ?>">
</div>

<div class="mb-3">
<label>Apellido</label>
<input type="text" name="apellido" class="form-control"
value="<?php echo $fila['apellido']; ?>">
</div>

<div class="mb-3">
<label>Especialidad</label>
<input type="text" name="especialidad" class="form-control"
value="<?php echo $fila['especialidad']; ?>">
</div>

<div class="mb-3">
<label>Teléfono</label>
<input type="text" name="telefono" class="form-control"
value="<?php echo $fila['telefono']; ?>">
</div>

<div class="mb-3">
<label>Correo</label>
<input type="email" name="correo" class="form-control"
value="<?php echo $fila['correo']; ?>">
</div>

<button type="submit" name="actualizar" class="btn btn-success">
Guardar Cambios
</button>

<a href="doctores.php" class="btn btn-secondary">
Cancelar
</a>

</form>

</div>

</div>

</body>
</html>