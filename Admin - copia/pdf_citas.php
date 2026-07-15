<?php
ob_start();

require('../fpdf.php');
include('../Config/conexion.php');

$pdf=new FPDF('L');
$pdf->AddPage();

$pdf->SetFont('Arial','B',16);
$pdf->Cell(275,10,'REPORTE DE CITAS',0,1,'C');

$pdf->Ln(5);

$pdf->SetFont('Arial','B',10);

$pdf->Cell(15,8,'ID',1);
$pdf->Cell(30,8,'Paciente',1);
$pdf->Cell(30,8,'Doctor',1);
$pdf->Cell(30,8,'Fecha',1);
$pdf->Cell(30,8,'Hora',1);
$pdf->Cell(110,8,'Motivo',1);
$pdf->Cell(30,8,'Estado',1);

$pdf->Ln();

$pdf->SetFont('Arial','',9);

$sql="SELECT * FROM citas";
$res=mysqli_query($conexion,$sql);

while($f=mysqli_fetch_assoc($res))
{
    $pdf->Cell(15,8,$f['id'],1);
    $pdf->Cell(30,8,$f['paciente_id'],1);
    $pdf->Cell(30,8,$f['doctor_id'],1);
    $pdf->Cell(30,8,$f['fecha'],1);
    $pdf->Cell(30,8,$f['hora'],1);
    $pdf->Cell(110,8,$f['motivo'],1);
    $pdf->Cell(30,8,$f['estado'],1);
    $pdf->Ln();
}

ob_end_clean();
$pdf->Output();
?>