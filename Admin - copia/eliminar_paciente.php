<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
}

include("../Config/conexion.php");

$id = $_GET['id'];

$sql = "DELETE FROM pacientes WHERE id='$id'";

mysqli_query($conexion,$sql);

header("Location: pacientes.php");
exit();