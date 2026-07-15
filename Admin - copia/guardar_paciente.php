<?php

include("../Config/conexion.php");

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$edad = $_POST['edad'];
$sexo = $_POST['sexo'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$correo = $_POST['correo'];

$sql = "INSERT INTO pacientes
(nombre,apellido,edad,sexo,telefono,direccion,correo)
VALUES
('$nombre','$apellido','$edad','$sexo','$telefono','$direccion','$correo')";

if(mysqli_query($conexion,$sql)){

    header("Location: pacientes.php");

}else{

    echo "Error: ".mysqli_error($conexion);

}
?>