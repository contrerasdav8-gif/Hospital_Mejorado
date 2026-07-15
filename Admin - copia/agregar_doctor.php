<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Agregar Doctor</title>

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
    box-shadow:0px 0px 15px rgba(0,0,0,.15);
}

</style>

</head>

<body>

<div class="contenedor">

<div class="card p-4">

<h2>👨‍⚕️ Registrar Doctor</h2>

<hr>

<form action="guardar_doctor.php" method="POST">

<div class="mb-3">
<label>Nombre</label>
<input type="text" name="nombre" class="form-control" required>
</div>

<div class="mb-3">
<label>Apellido</label>
<input type="text" name="apellido" class="form-control" required>
</div>

<div class="mb-3">
<label>Especialidad</label>
<input type="text" name="especialidad" class="form-control" required>
</div>

<div class="mb-3">
<label>Teléfono</label>
<input type="text" name="telefono" class="form-control">
</div>

<div class="mb-3">
<label>Correo</label>
<input type="email" name="correo" class="form-control">
</div>

<button class="btn btn-success" name="guardar">
Guardar Doctor
</button>

<a href="doctores.php" class="btn btn-secondary">
Cancelar
</a>

</form>

</div>

</div>

</body>

</html>