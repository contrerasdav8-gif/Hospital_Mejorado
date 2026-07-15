<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
}

require('../fpdf/fpdf.php'); // Si tu archivo está en otra ruta, cámbiala

include("../Config/conexion.php");

class PDF extends FPDF
{

function Header()
{

$this->SetFillColor(13,110,253);
$this->Rect(0,0,220,30,'F');

$this->SetTextColor(255,255,255);
$this->SetFont('Arial','B',18);
$this->Cell(0,12,'HOSPITAL SALUD INTEGRAL',0,1,'C');

$this->SetFont('Arial','',11);
$this->Cell(0,6,'Reporte General del Sistema Hospitalario',0,1,'C');

$this->Ln(8);

$this->SetTextColor(0,0,0);

}

function Footer()
{

$this->SetY(-15);

$this->SetFont('Arial','I',9);

$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');

}

}

$pdf = new PDF();

$pdf->AliasNbPages();

$pdf->AddPage();

$pdf->SetFont('Arial','',11);

$pdf->Cell(0,8,"Fecha: ".date("d/m/Y H:i:s"),0,1);

$pdf->Ln(3);

/*=================================================
  ESTADISTICAS
==================================================*/

$pacientes=mysqli_fetch_assoc(mysqli_query($conexion,"SELECT COUNT(*) total FROM pacientes"));
$doctores=mysqli_fetch_assoc(mysqli_query($conexion,"SELECT COUNT(*) total FROM doctores"));
$citas=mysqli_fetch_assoc(mysqli_query($conexion,"SELECT COUNT(*) total FROM citas"));
$usuarios=mysqli_fetch_assoc(mysqli_query($conexion,"SELECT COUNT(*) total FROM usuarios"));
$historial=mysqli_fetch_assoc(mysqli_query($conexion,"SELECT COUNT(*) total FROM historial_clinico"));

$pdf->SetFont('Arial','B',12);

$pdf->Cell(0,8,"ESTADISTICAS GENERALES",0,1);

$pdf->SetFont('Arial','',11);

$pdf->Cell(0,7,"Pacientes registrados: ".$pacientes['total'],0,1);

$pdf->Cell(0,7,"Doctores registrados: ".$doctores['total'],0,1);

$pdf->Cell(0,7,"Citas registradas: ".$citas['total'],0,1);

$pdf->Cell(0,7,"Usuarios registrados: ".$usuarios['total'],0,1);

$pdf->Cell(0,7,"Historiales Clinicos: ".$historial['total'],0,1);

$pdf->Ln(8);

/*=================================================
  PACIENTES
==================================================*/

$pdf->SetFillColor(13,110,253);

$pdf->SetTextColor(255);

$pdf->SetFont('Arial','B',12);

$pdf->Cell(0,8,"PACIENTES",1,1,'C',true);

$pdf->SetTextColor(0);

$pdf->SetFont('Arial','B',10);

$pdf->Cell(10,8,"ID",1);

$pdf->Cell(45,8,"Nombre",1);

$pdf->Cell(45,8,"Apellido",1);

$pdf->Cell(20,8,"Edad",1);

$pdf->Cell(30,8,"Sexo",1);

$pdf->Cell(40,8,"Telefono",1);

$pdf->Ln();

$pdf->SetFont('Arial','',9);

$sql=mysqli_query($conexion,"SELECT * FROM pacientes");

while($fila=mysqli_fetch_assoc($sql))
{

$pdf->Cell(10,8,$fila['id'],1);

$pdf->Cell(45,8,utf8_decode($fila['nombre']),1);

$pdf->Cell(45,8,utf8_decode($fila['apellido']),1);

$pdf->Cell(20,8,$fila['edad'],1);

$pdf->Cell(30,8,$fila['sexo'],1);

$pdf->Cell(40,8,$fila['telefono'],1);

$pdf->Ln();

}

$pdf->Ln(10);

/*=================================================
  DOCTORES
==================================================*/

$pdf->SetFillColor(25,135,84);

$pdf->SetTextColor(255);

$pdf->SetFont('Arial','B',12);

$pdf->Cell(0,8,"DOCTORES",1,1,'C',true);

$pdf->SetTextColor(0);

$pdf->SetFont('Arial','B',10);

$pdf->Cell(10,8,"ID",1);

$pdf->Cell(60,8,"Nombre",1);

$pdf->Cell(60,8,"Especialidad",1);

$pdf->Cell(60,8,"Telefono",1);

$pdf->Ln();

$pdf->SetFont('Arial','',9);

$sql=mysqli_query($conexion,"SELECT * FROM doctores");

while($fila=mysqli_fetch_assoc($sql))
{

$pdf->Cell(10,8,$fila['id'],1);

$pdf->Cell(60,8,utf8_decode($fila['nombre']." ".$fila['apellido']),1);

$pdf->Cell(60,8,utf8_decode($fila['especialidad']),1);

$pdf->Cell(60,8,$fila['telefono'],1);

$pdf->Ln();

}

$pdf->Ln(10);

/*=================================================
  CITAS
==================================================*/

$pdf->SetFillColor(255,193,7);

$pdf->SetTextColor(0);

$pdf->SetFont('Arial','B',12);

$pdf->Cell(0,8,"CITAS",1,1,'C',true);

$pdf->SetFont('Arial','B',10);

$pdf->Cell(20,8,"ID",1);

$pdf->Cell(35,8,"Paciente",1);

$pdf->Cell(35,8,"Doctor",1);

$pdf->Cell(30,8,"Fecha",1);

$pdf->Cell(25,8,"Hora",1);

$pdf->Cell(45,8,"Estado",1);

$pdf->Ln();

$pdf->SetFont('Arial','',9);

$sql=mysqli_query($conexion,"
SELECT
citas.*,
pacientes.nombre AS paciente,
doctores.nombre AS doctor
FROM citas
LEFT JOIN pacientes
ON citas.paciente_id=pacientes.id
LEFT JOIN doctores
ON citas.doctor_id=doctores.id
");

while($fila=mysqli_fetch_assoc($sql))
{

$pdf->Cell(20,8,$fila['id'],1);

$pdf->Cell(35,8,utf8_decode($fila['paciente']),1);

$pdf->Cell(35,8,utf8_decode($fila['doctor']),1);

$pdf->Cell(30,8,$fila['fecha'],1);

$pdf->Cell(25,8,$fila['hora'],1);

$pdf->Cell(45,8,$fila['estado'],1);

$pdf->Ln();

}

$pdf->Output("I","Reporte_Hospital.pdf");
?>