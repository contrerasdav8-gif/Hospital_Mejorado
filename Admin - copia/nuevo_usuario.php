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
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<title>Nuevo Usuario</title>

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
    box-shadow:0px 5px 15px rgba(0,0,0,.15);
}

</style>

</head>

<body>

<div class="container mt-5">

<div class="card">

<div class="card-header bg-success text-white">

<h3><i class="bi bi-person-plus-fill"></i> Registrar Nuevo Usuario</h3>

</div>

<div class="card-body">

<form action="guardar_usuario.php" method="POST">

<div class="mb-3">

<label class="form-label">Nombre Completo</label>

<input
type="text"
name="nombre"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">Usuario</label>

<input
type="text"
name="usuario"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">Contraseña</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">Rol</label>

<select
name="rol"
class="form-select"
required>

<option value="">Seleccione...</option>

<option value="Administrador">Administrador</option>

<option value="Doctor">Doctor</option>

<option value="Paciente">Paciente</option>

</select>

</div>

<button
type="submit"
class="btn btn-success">

<i class="bi bi-save"></i>

Guardar Usuario

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