<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
}

if($_SESSION['rol'] != "Administrador"){
    header("Location: ../index.php");
    exit();
}

include("../Config/conexion.php");

$buscar = "";

if(isset($_GET['buscar'])){
    $buscar = mysqli_real_escape_string($conexion,$_GET['buscar']);

    $sql = "SELECT * FROM usuarios
            WHERE nombre LIKE '%$buscar%'
            OR usuario LIKE '%$buscar%'
            OR rol LIKE '%$buscar%'
            ORDER BY id DESC";
}else{

    $sql = "SELECT * FROM usuarios ORDER BY id DESC";

}

$resultado = mysqli_query($conexion,$sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Usuarios</title>

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
box-shadow:0px 5px 15px rgba(0,0,0,.1);

}

.table th{
background:#0d6efd;
color:white;
}

</style>

</head>

<body>

<div class="container mt-5">

<div class="card">

<div class="card-header bg-primary text-white">

<h3>

<i class="bi bi-people-fill"></i>

Administración de Usuarios

</h3>

</div>

<div class="card-body">

<div class="row mb-3">

<div class="col-md-8">

<form method="GET">

<div class="input-group">

<input
type="text"
name="buscar"
class="form-control"
placeholder="Buscar usuario..."
value="<?php echo $buscar; ?>">

<button class="btn btn-primary">

<i class="bi bi-search"></i>

Buscar

</button>

</div>

</form>

</div>

<div class="col-md-4 text-end">

<a href="nuevo_usuario.php"
class="btn btn-success">

<i class="bi bi-person-plus-fill"></i>

Nuevo Usuario

</a>

</div>

</div>

<table class="table table-hover table-bordered">

<thead>

<tr>

<th>ID</th>

<th>Nombre</th>

<th>Usuario</th>

<th>Rol</th>

<th>Fecha Registro</th>

<th width="170">Acciones</th>

</tr>

</thead>

<tbody>

<?php

while($fila=mysqli_fetch_assoc($resultado)){

?>

<tr>

<td><?php echo $fila['id']; ?></td>

<td><?php echo $fila['nombre']; ?></td>

<td><?php echo $fila['usuario']; ?></td>

<td>

<?php

if($fila['rol']=="Administrador"){

echo "<span class='badge bg-danger'>Administrador</span>";

}

elseif($fila['rol']=="Doctor"){

echo "<span class='badge bg-success'>Doctor</span>";

}

else{

echo "<span class='badge bg-primary'>Paciente</span>";

}

?>

</td>

<td>

<?php echo $fila['fecha_registro']; ?>

</td>

<td>

<a

href="editar_usuario.php?id=<?php echo $fila['id'];?>"

class="btn btn-warning btn-sm">

<i class="bi bi-pencil-fill"></i>

</a>

<a

href="eliminar_usuario.php?id=<?php echo $fila['id'];?>"

class="btn btn-danger btn-sm"

onclick="return confirm('¿Eliminar este usuario?')">

<i class="bi bi-trash-fill"></i>

</a>

</td>

</tr>

<?php

}

?>

</tbody>

</table>

<div class="mt-4">

<a

href="dashboard.php"

class="btn btn-secondary">

<i class="bi bi-arrow-left-circle"></i>

Volver al Dashboard

</a>

</div>

</div>

</div>

</div>

</body>

</html>