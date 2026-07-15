<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
}

include("../Config/conexion.php");

$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$especialidad=$_POST['especialidad'];
$telefono=$_POST['telefono'];
$correo=$_POST['correo'];

$sql="INSERT INTO doctores
(nombre,apellido,especialidad,telefono,correo)
VALUES
('$nombre','$apellido','$especialidad','$telefono','$correo')";

mysqli_query($conexion,$sql);

header("Location: doctores.php");
exit();
?>