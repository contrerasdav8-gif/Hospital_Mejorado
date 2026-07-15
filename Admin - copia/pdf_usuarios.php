<?php
ob_start();

require('../fpdf.php');
include('../Config/conexion.php');

$pdf=new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial','B',16);
$pdf->Cell(190,10,'REPORTE DE USUARIOS',0,1,'C');

$pdf->Ln(5);

$pdf->SetFont('Arial','B',10);

$pdf->Cell(15,8,'ID',1);
$pdf->Cell(60,8,'Nombre',1);
$pdf->Cell(55,8,'Usuario',1);
$pdf->Cell(40,8,'Rol',1);

$pdf->Ln();

$pdf->SetFont('Arial','',9);

$sql="SELECT * FROM usuarios";
$res=mysqli_query($conexion,$sql);

while($f=mysqli_fetch_assoc($res))
{
    $pdf->Cell(15,8,$f['id'],1);
    $pdf->Cell(60,8,$f['nombre'],1);
    $pdf->Cell(55,8,$f['usuario'],1);
    $pdf->Cell(40,8,$f['rol'],1);
    $pdf->Ln();
}

ob_end_clean();
$pdf->Output();
?>