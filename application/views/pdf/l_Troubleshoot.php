<?php
$no=1;
$tgl = date("d M Y");
$pdf = new MC_Table('P','mm','A4');
$pdf->setTopMargin(15);
$pdf->setLeftMargin(12);
$pdf->SetFont('helvetica','',9);

$pdf->AddPage();
$pdf->ln(7);
$pdf->Image('http://localhost:8080/SIUJAR/assets/images/lg1_logo.png',96,10,20);
$pdf->ln(10);
$pdf->SetFont('helvetica','B',11);
$pdf->Cell(186,5,'UPT JARINGAN & KOMPUTER INSTITUT ASIA MALANG',0,1,'C');
$pdf->Cell(186,5,'LAPORAN REKAP DATA TROUBLESHOOTING',0,1,'C');
$pdf->ln(7);
$pdf->SetFont('helvetica','B',8);
$pdf->SetWidths(array(7,35,25,20,20,20,59));
    $pdf->Row1(array(
                array("No","C"),
                array("Jenis","C"),
                array("Pelapor","C"),
                array("Tanggal Lapor","C"),
                array("Tanggal Diperbaiki","C"),
                array("Teknisi","C"),
                array("Deskripsi","C")
    ));
foreach($troble as $data) {
$pdf->SetFont('helvetica','',8);
    $pdf->Row1(array(
                array($data->idPenanganan,"C"),
                array($data->Jenismslh,"L"),
                array($data->Pelapor,"C"),
                array($data->tgllapor,"C"),
                array($data->tgperbaikan,"C"),
                array($data->Teknisi,"C"),
                array($data->Deskripsi,"L")
    ));}
$pdf->ln(10);
$pdf->Output("Rekap_Troubleshooting.pdf","I");
?>