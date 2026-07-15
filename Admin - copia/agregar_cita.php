<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
}

include("../Config/conexion.php");

// Pacientes
$pacientes = mysqli_query($conexion,"SELECT * FROM pacientes ORDER BY nombre ASC");

// Doctores
$doctores = mysqli_query($conexion,"SELECT * FROM doctores ORDER BY nombre ASC");

if(isset($_POST['guardar'])){

    $paciente = $_POST['paciente'];
    $doctor = $_POST['doctor'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $motivo = $_POST['motivo'];
    $estado = $_POST['estado'];

    $sql = "INSERT INTO citas
    (paciente_id,doctor_id,fecha,hora,motivo,estado)

    VALUES

    ('$paciente','$doctor','$fecha','$hora','$motivo','$estado')";

    mysqli_query($conexion,$sql);

    header("Location: citas.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Nueva Cita</title>

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

<h2>📅 Registrar Nueva Cita</h2>

<hr>

<form method="POST">

<div class="mb-3">

<label>Paciente</label>

<select name="paciente" class="form-control" required>

<option value="">Seleccione...</option>

<?php while($p=mysqli_fetch_assoc($pacientes)){ ?>

<option value="<?php echo $p['id']; ?>">

<?php echo $p['nombre']." ".$p['apellido']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Doctor</label>

<select name="doctor" class="form-control" required>

<option value="">Seleccione...</option>

<?php while($d=mysqli_fetch_assoc($doctores)){ ?>

<option value="<?php echo $d['id']; ?>">

<?php echo $d['nombre']." ".$d['apellido']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Fecha</label>

<input type="date" name="fecha" class="form-control" required>

</div>

<div class="mb-3">

<label>Hora</label>

<input type="time" name="hora" class="form-control" required>

</div>

<div class="mb-3">

<label>Motivo</label>

<textarea name="motivo" class="form-control" rows="3"></textarea>

</div>

<div class="mb-3">

<label>Estado</label>

<select name="estado" class="form-control">

<option>Pendiente</option>

<option>Atendida</option>

<option>Cancelada</option>

</select>

</div>

<button type="submit" name="guardar" class="btn btn-success">

Guardar Cita

</button>

<a href="citas.php" class="btn btn-secondary">

Cancelar

</a>

</form>

</div>

</div>

</body>

</html>