<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
}

include("../Config/conexion.php");

if(isset($_POST['paciente_id'])){

    $paciente_id = $_POST['paciente_id'];
    $doctor_id = $_POST['doctor_id'];
    $diagnostico = $_POST['diagnostico'];
    $tratamiento = $_POST['tratamiento'];
    $observaciones = $_POST['observaciones'];
    $fecha = $_POST['fecha'];

    $sql = "INSERT INTO historial_clinico
    (paciente_id, doctor_id, diagnostico, tratamiento, observaciones, fecha)

    VALUES

    ('$paciente_id',
    '$doctor_id',
    '$diagnostico',
    '$tratamiento',
    '$observaciones',
    '$fecha')";

    if(mysqli_query($conexion,$sql)){

        header("Location: historial_clinico.php");
        exit();

    }else{

        echo "Error al guardar: ".mysqli_error($conexion);

    }

}else{

    echo "No llegaron datos.";

}
?>