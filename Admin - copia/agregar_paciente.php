<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Nuevo Paciente</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f4f6f9;
}

.card{
    margin-top:40px;
    border:none;
    border-radius:15px;
    box-shadow:0 0 15px rgba(0,0,0,.2);
}

h2{
    text-align:center;
    margin-bottom:20px;
}
</style>

</head>

<body>

<div class="container">

<div class="card p-4">

<h2>➕ Registrar Paciente</h2>

<form action="guardar_paciente.php" method="POST">

<div class="row">

<div class="col-md-6 mb-3">
<label>Nombre</label>
<input type="text" name="nombre" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label>Apellido</label>
<input type="text" name="apellido" class="form-control" required>
</div>

<div class="col-md-4 mb-3">
<label>Edad</label>
<input type="number" name="edad" class="form-control">
</div>

<div class="col-md-4 mb-3">
<label>Sexo</label>

<select name="sexo" class="form-control">

<option value="Masculino">Masculino</option>

<option value="Femenino">Femenino</option>

</select>

</div>

<div class="col-md-4 mb-3">
<label>Teléfono</label>
<input type="text" name="telefono" class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Dirección</label>
<input type="text" name="direccion" class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Correo</label>
<input type="email" name="correo" class="form-control">
</div>

</div>

<button class="btn btn-success">
Guardar Paciente
</button>

<a href="pacientes.php" class="btn btn-secondary">
Cancelar
</a>

</form>

</div>

</div>

</body>
</html>