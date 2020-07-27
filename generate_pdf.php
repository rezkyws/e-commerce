<?php
//include connection file
include_once("pdf.php");
include_once('libs/fpdf.php');

class PDF extends FPDF
{
// Page header
    function Header()
    {
        // Logo
        $this->Image('logo.png',10,-1,20);
        $this->SetFont('Arial','B',13);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(80,10,'History Penjualan',1,0,'C');
        // Line break
        $this->Ln(20);
    }

// Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

$db = new dbObj();
$connString =  $db->getConnstring();
$display_heading = array('ID_TRANSAKSI'=>'ID', 'TGL_TRANSAKSI'=> 'Date', 'NAMA_PEMBELI'=> 'Nama Pembeli','NO_HP'=> 'No. Hp','ALAMAT'=> 'Alamat','KODE_POS'=> 'Kode Pos', 'TOTAL_PEMBAYARAN'=> 'Total Bayar',);

$result = mysqli_query($connString, "SELECT ID_TRANSAKSI, TGL_TRANSAKSI, NAMA_PEMBELI, NO_HP, ALAMAT, KODE_POS, TOTAL_PEMBAYARAN FROM penjualan") or die("database error:". mysqli_error($connString));
$header = mysqli_query($display_heading, "SHOW columns FROM employee");

$pdf = new PDF();
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',8);
foreach($header as $heading) {
    $pdf->Cell(40,12,$display_heading[$heading['Field']],1);
}
foreach($result as $row) {
    $pdf->Ln();
    foreach($row as $column)
        $pdf->Cell(40,12,$column,1);
}
$pdf->Output();