<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
}

include("../Config/conexion.php");

$pacientes = mysqli_query($conexion,"SELECT * FROM pacientes ORDER BY nombre");
$doctores = mysqli_query($conexion,"SELECT * FROM doctores ORDER BY nombre");

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Nuevo Historial Clínico</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f6f9;
}

.card{
    max-width:800px;
    margin:auto;
    margin-top:40px;
    border:none;
    box-shadow:0px 0px 15px rgba(0,0,0,.15);
}

</style>

</head>

<body>

<div class="container">

<div class="card p-4">

<h2>📋 Registrar Historial Clínico</h2>

<hr>

<form action="guardar_historial.php" method="POST">

<div class="mb-3">

<label>Paciente</label>

<select name="paciente_id" class="form-control" required>

<option value="">Seleccione un paciente</option>

<?php while($p=mysqli_fetch_assoc($pacientes)){ ?>

<option value="<?php echo $p['id']; ?>">

<?php echo $p['nombre']." ".$p['apellido']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Doctor</label>

<select name="doctor_id" class="form-control" required>

<option value="">Seleccione un doctor</option>

<?php while($d=mysqli_fetch_assoc($doctores)){ ?>

<option value="<?php echo $d['id']; ?>">

<?php echo $d['nombre']." ".$d['apellido']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Diagnóstico</label>

<textarea
name="diagnostico"
class="form-control"
rows="3"
required></textarea>

</div>

<div class="mb-3">

<label>Tratamiento</label>

<textarea
name="tratamiento"
class="form-control"
rows="3"
required></textarea>

</div>

<div class="mb-3">

<label>Observaciones</label>

<textarea
name="observaciones"
class="form-control"
rows="3"></textarea>

</div>

<div class="mb-3">

<label>Fecha</label>

<input
type="date"
name="fecha"
class="form-control"
required>

</div>

<button class="btn btn-success">

Guardar Historial

</button>

<a href="historial_clinico.php" class="btn btn-secondary">

Cancelar

</a>

</form>

</div>

</div>

</body>

</html>