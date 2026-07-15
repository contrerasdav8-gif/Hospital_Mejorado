<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
}

include("../Config/conexion.php");

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $sql = "DELETE FROM doctores WHERE id='$id'";

    mysqli_query($conexion,$sql);
}

header("Location: doctores.php");
exit();
?>