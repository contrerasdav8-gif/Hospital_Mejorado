<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
}

include("../Config/conexion.php");

/* BUSCADOR */
$buscar = "";

if(isset($_GET['buscar']) && $_GET['buscar'] != ""){

    $buscar = $_GET['buscar'];

    $sql = "SELECT * FROM pacientes
            WHERE nombre LIKE '%$buscar%'
            OR apellido LIKE '%$buscar%'
            ORDER BY id DESC";

}else{

    $sql = "SELECT * FROM pacientes ORDER BY id DESC";

}

$resultado = mysqli_query($conexion,$sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Pacientes</title>

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
    color:white;

    padding:20px;
}

.sidebar h2{

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

<h2>👨‍⚕️ Administración de Pacientes</h2>

<hr>

<form method="GET" class="row mb-3">

<div class="col-md-6">

<input
type="text"
name="buscar"
class="form-control"
placeholder="Buscar por nombre o apellido"
value="<?php echo $buscar; ?>">

</div>

<div class="col-md-2">

<button class="btn btn-primary w-100">

Buscar

</button>

</div>

<div class="col-md-4 text-end">

<a href="agregar_paciente.php" class="btn btn-success">

➕ Nuevo Paciente

</a>

</div>

</form>

<table class="table table-bordered table-hover">

<thead class="table-primary">

<tr>

<th>ID</th>

<th>Nombre</th>

<th>Apellido</th>

<th>Edad</th>

<th>Sexo</th>

<th>Teléfono</th>

<th>Dirección</th>

<th>Correo</th>

<th width="170">Acciones</th>

</tr>

</thead>

<tbody>

<?php

if(mysqli_num_rows($resultado)>0){

while($fila=mysqli_fetch_assoc($resultado)){

?>

<tr>

<td><?php echo $fila['id']; ?></td>

<td><?php echo $fila['nombre']; ?></td>

<td><?php echo $fila['apellido']; ?></td>

<td><?php echo $fila['edad']; ?></td>

<td><?php echo $fila['sexo']; ?></td>

<td><?php echo $fila['telefono']; ?></td>

<td><?php echo $fila['direccion']; ?></td>

<td><?php echo $fila['correo']; ?></td>

<td>

<a href="editar_paciente.php?id=<?php echo $fila['id']; ?>" class="btn btn-warning btn-sm">

Editar

</a>

<a
href="eliminar_paciente.php?id=<?php echo $fila['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('¿Seguro que deseas eliminar este paciente?')">

Eliminar

</a>

</td>

</tr>

<?php

}

}else{

?>

<tr>

<td colspan="9" class="text-center">

No se encontraron pacientes.

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>

</div>

</body>

</html>