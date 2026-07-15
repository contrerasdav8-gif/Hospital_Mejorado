<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
}

include("../Config/conexion.php");

$buscar = "";

if(isset($_GET['buscar'])){
    $buscar = mysqli_real_escape_string($conexion,$_GET['buscar']);
}

$sql = "SELECT historial_clinico.*,

pacientes.nombre AS paciente,
pacientes.apellido AS apellido_paciente,

doctores.nombre AS doctor,
doctores.apellido AS apellido_doctor

FROM historial_clinico

INNER JOIN pacientes
ON historial_clinico.paciente_id = pacientes.id

INNER JOIN doctores
ON historial_clinico.doctor_id = doctores.id

WHERE pacientes.nombre LIKE '%$buscar%'
OR pacientes.apellido LIKE '%$buscar%'
OR doctores.nombre LIKE '%$buscar%'
OR doctores.apellido LIKE '%$buscar%'

ORDER BY historial_clinico.id DESC";

$resultado = mysqli_query($conexion,$sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Historial Clínico</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f6f9;
}

.sidebar{

    position:fixed;
    left:0;
    top:0;

    width:250px;
    height:100vh;

    background:#0d6efd;

    padding:20px;
}

.sidebar h2{

    color:white;

    text-align:center;

    margin-bottom:30px;
}

.sidebar a{

    display:block;

    color:white;

    text-decoration:none;

    padding:12px;

    margin-bottom:10px;

    border-radius:8px;
}

.sidebar a:hover{

    background:white;

    color:#0d6efd;
}

.contenido{

    margin-left:270px;

    padding:30px;
}

.card{

    border:none;

    box-shadow:0px 0px 15px rgba(0,0,0,.15);
}

</style>

</head>

<body>

<div class="sidebar">

<h2>🏥 Hospital</h2>

<a href="dashboard.php">🏠 Inicio</a>

<a href="pacientes.php">🧑 Pacientes</a>

<a href="doctores.php">👨‍⚕️ Doctores</a>

<a href="citas.php">📅 Citas</a>

<a href="historial_clinico.php">📋 Historial Clínico</a>

<a href="usuarios.php">👥 Usuarios</a>

<a href="reportes.php">📊 Reportes</a>

<a href="../logout.php">🚪 Cerrar Sesión</a>

</div>

<div class="contenido">

<div class="card p-4">

<h2>📋 Historial Clínico</h2>

<hr>

<form method="GET" class="mb-3">

<div class="row">

<div class="col-md-6">

<input
type="text"
name="buscar"
class="form-control"
placeholder="Buscar paciente o doctor..."
value="<?php echo $buscar; ?>">

</div>

<div class="col-md-2">

<button class="btn btn-primary w-100">

Buscar

</button>

</div>

<div class="col-md-2">

<a href="historial_clinico.php" class="btn btn-secondary w-100">

Limpiar

</a>

</div>

<div class="col-md-2">

<a href="agregar_historial.php" class="btn btn-success w-100">

➕ Nuevo

</a>

</div>

</div>

</form>

<table class="table table-bordered table-hover">

<thead class="table-primary">

<tr>

<th>ID</th>

<th>Paciente</th>

<th>Doctor</th>

<th>Diagnóstico</th>

<th>Tratamiento</th>

<th>Observaciones</th>

<th>Fecha</th>

<th>Acciones</th>

</tr>

</thead>

<tbody>

<?php while($fila=mysqli_fetch_assoc($resultado)){ ?>

<tr>

<td><?php echo $fila['id']; ?></td>

<td><?php echo $fila['paciente']." ".$fila['apellido_paciente']; ?></td>

<td><?php echo $fila['doctor']." ".$fila['apellido_doctor']; ?></td>

<td><?php echo $fila['diagnostico']; ?></td>

<td><?php echo $fila['tratamiento']; ?></td>

<td><?php echo $fila['observaciones']; ?></td>

<td><?php echo $fila['fecha']; ?></td>

<td>

<a href="editar_historial.php?id=<?php echo $fila['id']; ?>" class="btn btn-warning btn-sm">

Editar

</a>

<a href="eliminar_historial.php?id=<?php echo $fila['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('¿Eliminar historial?')">

Eliminar

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</body>

</html>