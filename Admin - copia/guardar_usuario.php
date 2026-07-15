<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit();
}

include("../Config/conexion.php");

// Obtener datos
$nombre = $_POST['nombre'];
$usuario = $_POST['usuario'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$rol = $_POST['rol'];

// Verificar si el usuario ya existe
$verificar = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$usuario'");

if(mysqli_num_rows($verificar) > 0){
    echo "<script>
            alert('Ese nombre de usuario ya existe.');
            window.location='nuevo_usuario.php';
          </script>";
    exit();
}

// Guardar usuario
$sql = "INSERT INTO usuarios(nombre, usuario, password, rol)
VALUES('$nombre','$usuario','$password','$rol')";

if(mysqli_query($conexion,$sql)){
    echo "<script>
            alert('Usuario registrado correctamente.');
            window.location='usuarios.php';
          </script>";
}else{
    echo "Error: ".mysqli_error($conexion);
}
?>