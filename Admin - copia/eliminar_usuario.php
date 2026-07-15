<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
}

include("../Config/conexion.php");

$id = $_GET['id'];

// Evitar eliminar al administrador principal
if($id == $_SESSION['id']){
    echo "<script>
            alert('No puedes eliminar tu propio usuario.');
            window.location='usuarios.php';
          </script>";
    exit();
}

$sql = "DELETE FROM usuarios WHERE id='$id'";

if(mysqli_query($conexion,$sql)){
    echo "<script>
            alert('Usuario eliminado correctamente.');
            window.location='usuarios.php';
          </script>";
}else{
    echo "Error: ".mysqli_error($conexion);
}
?>