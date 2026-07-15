<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
}

include("../Config/conexion.php");

$pacientes = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM pacientes"));
$doctores = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM doctores"));
$usuarios = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM usuarios"));
$citas = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM citas"));
$historial = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM historial_clinico"));
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Reportes</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{
background:#eef2f7;
}

.card{
border:none;
border-radius:18px;
box-shadow:0 10px 25px rgba(0,0,0,.12);
transition:.3s;
}

.card:hover{
transform:translateY(-6px);
}

h1{
font-weight:bold;
}

.btn{
font-size:18px;
padding:15px;
}

</style>

</head>

<body>

<div class="container mt-5">

<div class="card">

<div class="card-header bg-primary text-white">

<h2>
<i class="bi bi-file-earmark-bar-graph-fill"></i>
Centro de Reportes
</h2>

</div>

<div class="card-body">

<div class="row text-center mb-5">

<div class="col-md-2">
<div class="card bg-primary text-white p-3">
<h3><?php echo $pacientes; ?></h3>
Pacientes
</div>
</div>

<div class="col-md-2">
<div class="card bg-success text-white p-3">
<h3><?php echo $doctores; ?></h3>
Doctores
</div>
</div>

<div class="col-md-2">
<div class="card bg-warning text-dark p-3">
<h3><?php echo $citas; ?></h3>
Citas
</div>
</div>

<div class="col-md-3">
<div class="card bg-danger text-white p-3">
<h3><?php echo $usuarios; ?></h3>
Usuarios
</div>
</div>

<div class="col-md-3">
<div class="card bg-secondary text-white p-3">
<h3><?php echo $historial; ?></h3>
Historial Clínico
</div>
</div>

</div>

<hr>

<h3 class="mb-4">
Seleccione el reporte que desea generar
</h3>

<div class="row g-4">

<div class="col-md-6">

<a href="pdf_pacientes.php" class="btn btn-primary w-100">

<i class="bi bi-person-lines-fill"></i>

Reporte de Pacientes

</a>

</div>

<div class="col-md-6">

<a href="pdf_doctores.php" class="btn btn-success w-100">

<i class="bi bi-heart-pulse-fill"></i>

Reporte de Doctores

</a>

</div>

<div class="col-md-6">

<a href="pdf_citas.php" class="btn btn-warning w-100">

<i class="bi bi-calendar2-check-fill"></i>

Reporte de Citas

</a>

</div>

<div class="col-md-6">

<a href="pdf_usuarios.php" class="btn btn-danger w-100">

<i class="bi bi-people-fill"></i>

Reporte de Usuarios

</a>

</div>

<div class="col-md-12">

<a href="dashboard.php" class="btn btn-dark w-100">

<i class="bi bi-arrow-left-circle"></i>

Volver al Dashboard

</a>

</div>

</div>

</div>

</div>

</div>

</body>

</html>