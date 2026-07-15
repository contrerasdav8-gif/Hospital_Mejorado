<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
}

include("../Config/conexion.php");

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$usuario = $_POST['usuario'];
$rol = $_POST['rol'];
$password = $_POST['password'];

if(!empty($password)){

    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE usuarios SET
            nombre='$nombre',
            usuario='$usuario',
            password='$password',
            rol='$rol'
            WHERE id='$id'";

}else{

    $sql = "UPDATE usuarios SET
            nombre='$nombre',
            usuario='$usuario',
            rol='$rol'
            WHERE id='$id'";

}

if(mysqli_query($conexion,$sql)){

    echo "<script>
            alert('Usuario actualizado correctamente');
            window.location='usuarios.php';
          </script>";

}else{

    echo "Error: ".mysqli_error($conexion);

}
?>