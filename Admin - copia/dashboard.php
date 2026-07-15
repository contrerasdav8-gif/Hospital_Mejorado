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

// Contadores
$pacientes = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM pacientes"));
$doctores = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM doctores"));
$citas = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM citas"));
$usuarios = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM usuarios"));
$historial = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM historial_clinico"));
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Panel Administrador</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{
background:#edf2f7;
font-family:Segoe UI;
}

.sidebar{

position:fixed;

left:0;

top:0;

width:250px;

height:100vh;

background:#0d6efd;

padding:20px;

color:white;

}

.sidebar h2{

text-align:center;

margin-bottom:35px;

}

.sidebar a{

display:block;

padding:14px;

margin-bottom:10px;

border-radius:10px;

color:white;

text-decoration:none;

font-size:17px;

transition:.3s;

}

.sidebar a:hover{

background:white;

color:#0d6efd;

}

.main{

margin-left:270px;

padding:30px;

}

.card-box{

border:none;

border-radius:20px;

color:white;

transition:.3s;

}

.card-box:hover{

transform:translateY(-6px);

}

.bg1{

background:#0d6efd;

}

.bg2{

background:#198754;

}

.bg3{

background:#ffc107;

color:black;

}

.bg4{

background:#dc3545;

}

.bg5{

background:#6f42c1;

}

.icon{

font-size:45px;

}

.navbar{

background:white;

border-radius:15px;

padding:15px;

box-shadow:0 5px 15px rgba(0,0,0,.1);

margin-bottom:25px;

}

</style>

</head>

<body>

<div class="sidebar">

<h2>🏥 Hospital</h2>

<a href="dashboard.php"><i class="bi bi-house"></i> Inicio</a>

<a href="pacientes.php"><i class="bi bi-person"></i> Pacientes</a>

<a href="doctores.php"><i class="bi bi-heart-pulse"></i> Doctores</a>

<a href="citas.php"><i class="bi bi-calendar-check"></i> Citas</a>

<a href="historial.php"><i class="bi bi-journal-medical"></i> Historial Clínico</a>

<a href="usuarios.php"><i class="bi bi-people"></i> Usuarios</a>

<a href="reportes.php"><i class="bi bi-bar-chart"></i> Reportes</a>

<a href="../logout.php"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a>

</div>

<div class="main">

<div class="navbar">

<h3>

Bienvenido

<b>

<?php echo $_SESSION['nombre']; ?>

</b>

</h3>

Administrador del Sistema Hospitalario

</div>

<div class="row g-4">

<div class="col-md-4">

<div class="card card-box bg1 p-4">

<div class="d-flex justify-content-between">

<div>

<h5>Pacientes</h5>

<h1><?php echo $pacientes; ?></h1>

</div>

<div class="icon">

<i class="bi bi-person-fill"></i>

</div>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card card-box bg2 p-4">

<div class="d-flex justify-content-between">

<div>

<h5>Doctores</h5>

<h1><?php echo $doctores; ?></h1>

</div>

<div class="icon">

<i class="bi bi-heart-pulse-fill"></i>

</div>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card card-box bg3 p-4">

<div class="d-flex justify-content-between">

<div>

<h5>Citas</h5>

<h1><?php echo $citas; ?></h1>

</div>

<div class="icon">

<i class="bi bi-calendar2-check-fill"></i>

</div>

</div>

</div>

</div>

<div class="col-md-6">

<div class="card card-box bg4 p-4">

<div class="d-flex justify-content-between">

<div>

<h5>Usuarios</h5>

<h1><?php echo $usuarios; ?></h1>

</div>

<div class="icon">

<i class="bi bi-people-fill"></i>

</div>

</div>

</div>

</div>

<div class="col-md-6">

<div class="card card-box bg5 p-4">

<div class="d-flex justify-content-between">

<div>

<h5>Historial Clínico</h5>

<h1><?php echo $historial; ?></h1>

</div>

<div class="icon">

<i class="bi bi-journal-medical"></i>

</div>

</div>

</div>

</div>

</div>

<br>

<div class="card p-4">

<h4>

<i class="bi bi-speedometer2"></i>

Accesos rápidos

</h4>

<hr>

<div class="row text-center">

<div class="col-md-3">

<a href="agregar_paciente.php" class="btn btn-primary w-100">

<i class="bi bi-person-plus"></i>

Nuevo Paciente

</a>

</div>

<div class="col-md-3">

<a href="agregar_doctor.php" class="btn btn-success w-100">

<i class="bi bi-heart-pulse"></i>

Nuevo Doctor

</a>

</div>

<div class="col-md-3">

<a href="agregar_cita.php" class="btn btn-warning w-100">

<i class="bi bi-calendar-plus"></i>

Nueva Cita

</a>

</div>

<div class="col-md-3">

<a href="agregar_historial.php" class="btn btn-danger w-100">

<i class="bi bi-file-earmark-medical"></i>

Nuevo Historial

</a>

</div>

</div>

</div>

<br>

<div class="card p-4">

<h4>

<i class="bi bi-person-circle"></i>

Información del usuario

</h4>

<hr>

<table class="table">

<tr>

<th>Nombre</th>

<td><?php echo $_SESSION['nombre']; ?></td>

</tr>

<tr>

<th>Rol</th>

<td><?php echo $_SESSION['rol']; ?></td>

</tr>

<tr>

<th>Estado</th>

<td>

<span class="badge bg-success">

Activo

</span>

</td>

</tr>

</table>

</div>

</div>

</body>

</html>