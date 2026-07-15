<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
}

include("../Config/conexion.php");

$id = $_GET['id'];

$sql = mysqli_query($conexion,"SELECT * FROM usuarios WHERE id='$id'");
$usuario = mysqli_fetch_assoc($sql);

if(!$usuario){
    die("Usuario no encontrado.");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Editar Usuario</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{
background:#eef2f7;
}

.card{
border:none;
border-radius:15px;
box-shadow:0px 5px 15px rgba(0,0,0,.2);
}

</style>

</head>

<body>

<div class="container mt-5">

<div class="card">

<div class="card-header bg-warning">

<h3>

<i class="bi bi-pencil-square"></i>

Editar Usuario

</h3>

</div>

<div class="card-body">

<form action="actualizar_usuario.php" method="POST">

<input
type="hidden"
name="id"
value="<?php echo $usuario['id']; ?>">

<div class="mb-3">

<label>Nombre</label>

<input
type="text"
name="nombre"
class="form-control"
value="<?php echo $usuario['nombre']; ?>"
required>

</div>

<div class="mb-3">

<label>Usuario</label>

<input
type="text"
name="usuario"
class="form-control"
value="<?php echo $usuario['usuario']; ?>"
required>

</div>

<div class="mb-3">

<label>Rol</label>

<select
name="rol"
class="form-select">

<option
value="Administrador"
<?php if($usuario['rol']=="Administrador") echo "selected"; ?>>
Administrador
</option>

<option
value="Doctor"
<?php if($usuario['rol']=="Doctor") echo "selected"; ?>>
Doctor
</option>

<option
value="Paciente"
<?php if($usuario['rol']=="Paciente") echo "selected"; ?>>
Paciente
</option>

</select>

</div>

<div class="mb-3">

<label>Nueva Contraseña (opcional)</label>

<input
type="password"
name="password"
class="form-control">

<small class="text-muted">
Déjala vacía para conservar la contraseña actual.
</small>

</div>

<button
class="btn btn-warning">

<i class="bi bi-save"></i>

Actualizar

</button>

<a
href="usuarios.php"
class="btn btn-secondary">

Cancelar

</a>

</form>

</div>

</div>

</div>

</body>

</html>