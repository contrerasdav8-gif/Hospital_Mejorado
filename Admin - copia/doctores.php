<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
}

include("../Config/conexion.php");

$buscar = "";

if(isset($_GET['buscar'])){
    $buscar = $_GET['buscar'];

    $sql = "SELECT * FROM doctores
            WHERE nombre LIKE '%$buscar%'
            OR apellido LIKE '%$buscar%'
            OR especialidad LIKE '%$buscar%'
            ORDER BY id DESC";
}else{
    $sql = "SELECT * FROM doctores ORDER BY id DESC";
}

$resultado = mysqli_query($conexion,$sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<title>Doctores</title>

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
    margin-bottom:35px;
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

<a href="usuarios.php">👥 Usuarios</a>

<a href="reportes.php">📊 Reportes</a>

<a href="../logout.php">🚪 Cerrar Sesión</a>

</div>

<div class="contenido">

<div class="card p-4">

<h2>👨‍⚕️ Administración de Doctores</h2>

<hr>

<form method="GET" class="row mb-3">

<div class="col-md-8">
<input
type="text"
name="buscar"
class="form-control"
placeholder="Buscar por nombre, apellido o especialidad"
value="<?php echo $buscar;?>">
</div>

<div class="col-md-2">
<button class="btn btn-primary w-100">
Buscar
</button>
</div>

<div class="col-md-2">
<a href="agregar_doctor.php" class="btn btn-success w-100">
Nuevo
</a>
</div>

</form>

<table class="table table-bordered table-hover">

<thead class="table-primary">

<tr>

<th>ID</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Especialidad</th>
<th>Teléfono</th>
<th>Correo</th>
<th>Acciones</th>

</tr>

</thead>

<tbody>

<?php while($fila=mysqli_fetch_assoc($resultado)){ ?>

<tr>

<td><?php echo $fila['id']; ?></td>
<td><?php echo $fila['nombre']; ?></td>
<td><?php echo $fila['apellido']; ?></td>
<td><?php echo $fila['especialidad']; ?></td>
<td><?php echo $fila['telefono']; ?></td>
<td><?php echo $fila['correo']; ?></td>

<td>

<a href="editar_doctor.php?id=<?php echo $fila['id']; ?>" class="btn btn-warning btn-sm">
Editar
</a>

<a href="eliminar_doctor.php?id=<?php echo $fila['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('¿Eliminar doctor?')">
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