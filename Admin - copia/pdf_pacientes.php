<?php
ob_start();

require('../fpdf.php');
include('../Config/conexion.php');

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial','B',16);
$pdf->Cell(190,10,'REPORTE DE PACIENTES',0,1,'C');

$pdf->Ln(5);

$pdf->SetFont('Arial','B',10);

$pdf->Cell(10,8,'ID',1);
$pdf->Cell(35,8,'Nombre',1);
$pdf->Cell(35,8,'Apellido',1);
$pdf->Cell(12,8,'Edad',1);
$pdf->Cell(20,8,'Sexo',1);
$pdf->Cell(35,8,'Telefono',1);
$pdf->Cell(43,8,'Correo',1);

$pdf->Ln();

$pdf->SetFont('Arial','',9);

$sql="SELECT * FROM pacientes";
$resultado=mysqli_query($conexion,$sql);

while($fila=mysqli_fetch_assoc($resultado))
{
    $pdf->Cell(10,8,$fila['id'],1);
    $pdf->Cell(35,8,$fila['nombre'],1);
    $pdf->Cell(35,8,$fila['apellido'],1);
    $pdf->Cell(12,8,$fila['edad'],1);
    $pdf->Cell(20,8,$fila['sexo'],1);
    $pdf->Cell(35,8,$fila['telefono'],1);
    $pdf->Cell(43,8,$fila['correo'],1);
    $pdf->Ln();
}

ob_end_clean();
$pdf->Output();
?>