<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
}

include("../Config/conexion.php");

$id = $_GET['id'];

if(isset($_POST['actualizar'])){

    $paciente_id = $_POST['paciente_id'];
    $doctor_id = $_POST['doctor_id'];
    $diagnostico = $_POST['diagnostico'];
    $tratamiento = $_POST['tratamiento'];
    $observaciones = $_POST['observaciones'];
    $fecha = $_POST['fecha'];

    $sql = "UPDATE historial_clinico SET

    paciente_id='$paciente_id',
    doctor_id='$doctor_id',
    diagnostico='$diagnostico',
    tratamiento='$tratamiento',
    observaciones='$observaciones',
    fecha='$fecha'

    WHERE id='$id'";

    mysqli_query($conexion,$sql);

    header("Location: historial_clinico.php");
    exit();
}

$historial = mysqli_query($conexion,"SELECT * FROM historial_clinico WHERE id='$id'");
$fila = mysqli_fetch_assoc($historial);

$pacientes = mysqli_query($conexion,"SELECT * FROM pacientes");
$doctores = mysqli_query($conexion,"SELECT * FROM doctores");

?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">

<title>Editar Historial</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-warning">

<h3>Editar Historial Clínico</h3>

</div>

<div class="card-body">

<form method="POST">

<label>Paciente</label>

<select name="paciente_id" class="form-control mb-3">

<?php while($p=mysqli_fetch_assoc($pacientes)){ ?>

<option
value="<?php echo $p['id'];?>"

<?php if($p['id']==$fila['paciente_id']) echo "selected"; ?>>

<?php echo $p['nombre']." ".$p['apellido'];?>

</option>

<?php } ?>

</select>

<label>Doctor</label>

<select name="doctor_id" class="form-control mb-3">

<?php while($d=mysqli_fetch_assoc($doctores)){ ?>

<option
value="<?php echo $d['id'];?>"

<?php if($d['id']==$fila['doctor_id']) echo "selected"; ?>>

<?php echo $d['nombre']." ".$d['apellido'];?>

</option>

<?php } ?>

</select>

<label>Diagnóstico</label>

<textarea name="diagnostico" class="form-control mb-3"><?php echo $fila['diagnostico']; ?></textarea>

<label>Tratamiento</label>

<textarea name="tratamiento" class="form-control mb-3"><?php echo $fila['tratamiento']; ?></textarea>

<label>Observaciones</label>

<textarea name="observaciones" class="form-control mb-3"><?php echo $fila['observaciones']; ?></textarea>

<label>Fecha</label>

<input
type="date"
name="fecha"
class="form-control mb-3"
value="<?php echo date('Y-m-d',strtotime($fila['fecha'])); ?>">

<button
type="submit"
name="actualizar"
class="btn btn-success">

Guardar Cambios

</button>

<a href="historial_clinico.php" class="btn btn-secondary">

Cancelar

</a>

</form>

</div>

</div>

</div>

</body>

</html>