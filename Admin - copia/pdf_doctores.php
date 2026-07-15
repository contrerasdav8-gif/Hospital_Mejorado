<?php
ob_start();

require('../fpdf.php');
include('../Config/conexion.php');

$pdf=new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial','B',16);
$pdf->Cell(190,10,'REPORTE DE DOCTORES',0,1,'C');

$pdf->Ln(5);

$pdf->SetFont('Arial','B',10);

$pdf->Cell(10,8,'ID',1);
$pdf->Cell(30,8,'Nombre',1);
$pdf->Cell(30,8,'Apellido',1);
$pdf->Cell(40,8,'Especialidad',1);
$pdf->Cell(30,8,'Telefono',1);
$pdf->Cell(50,8,'Correo',1);

$pdf->Ln();

$pdf->SetFont('Arial','',9);

$sql="SELECT * FROM doctores";
$res=mysqli_query($conexion,$sql);

while($f=mysqli_fetch_assoc($res))
{
    $pdf->Cell(10,8,$f['id'],1);
    $pdf->Cell(30,8,$f['nombre'],1);
    $pdf->Cell(30,8,$f['apellido'],1);
    $pdf->Cell(40,8,$f['especialidad'],1);
    $pdf->Cell(30,8,$f['telefono'],1);
    $pdf->Cell(50,8,$f['correo'],1);
    $pdf->Ln();
}

ob_end_clean();
$pdf->Output();
?>