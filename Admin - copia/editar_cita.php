<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
}

include("../Config/conexion.php");

$id = $_GET['id'];

$pacientes = mysqli_query($conexion,"SELECT * FROM pacientes ORDER BY nombre ASC");
$doctores = mysqli_query($conexion,"SELECT * FROM doctores ORDER BY nombre ASC");

if(isset($_POST['actualizar'])){

    $paciente=$_POST['paciente'];
    $doctor=$_POST['doctor'];
    $fecha=$_POST['fecha'];
    $hora=$_POST['hora'];
    $motivo=$_POST['motivo'];
    $estado=$_POST['estado'];

    $sql="UPDATE citas SET

    paciente_id='$paciente',
    doctor_id='$doctor',
    fecha='$fecha',
    hora='$hora',
    motivo='$motivo',
    estado='$estado'

    WHERE id='$id'";

    mysqli_query($conexion,$sql);

    header("Location: citas.php");
    exit();
}

$sql="SELECT * FROM citas WHERE id='$id'";
$resultado=mysqli_query($conexion,$sql);
$fila=mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Editar Cita</title>

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
box-shadow:0 0 15px rgba(0,0,0,.15);
}

</style>

</head>

<body>

<div class="contenedor">

<div class="card p-4">

<h2>Editar Cita</h2>

<hr>

<form method="POST">

<div class="mb-3">

<label>Paciente</label>

<select name="paciente" class="form-control">

<?php while($p=mysqli_fetch_assoc($pacientes)){ ?>

<option
value="<?php echo $p['id']; ?>"

<?php
if($p['id']==$fila['paciente_id']) echo "selected";
?>

>

<?php echo $p['nombre']." ".$p['apellido']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Doctor</label>

<select name="doctor" class="form-control">

<?php while($d=mysqli_fetch_assoc($doctores)){ ?>

<option

value="<?php echo $d['id']; ?>"

<?php
if($d['id']==$fila['doctor_id']) echo "selected";
?>

>

<?php echo $d['nombre']." ".$d['apellido']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Fecha</label>

<input
type="date"
name="fecha"
class="form-control"
value="<?php echo $fila['fecha']; ?>">
</div>

<div class="mb-3">

<label>Hora</label>

<input
type="time"
name="hora"
class="form-control"
value="<?php echo $fila['hora']; ?>">

</div>

<div class="mb-3">

<label>Motivo</label>

<textarea
name="motivo"
class="form-control"
rows="3"><?php echo $fila['motivo']; ?></textarea>

</div>

<div class="mb-3">

<label>Estado</label>

<select name="estado" class="form-control">

<option <?php if($fila['estado']=="Pendiente") echo "selected"; ?>>Pendiente</option>

<option <?php if($fila['estado']=="Atendida") echo "selected"; ?>>Atendida</option>

<option <?php if($fila['estado']=="Cancelada") echo "selected"; ?>>Cancelada</option>

</select>

</div>

<button class="btn btn-success" name="actualizar">

Guardar Cambios

</button>

<a href="citas.php" class="btn btn-secondary">

Cancelar

</a>

</form>

</div>

</div>

</body>

</html>