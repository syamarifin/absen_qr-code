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
$pdf->Cell(186,5,'LAPORAN REKAP DATA INVENTARIS',0,1,'C');
$pdf->ln(7);
$pdf->SetFont('helvetica','B',8);
$pdf->SetWidths(array(7,60,25,25,100));
    $pdf->Row1(array(
                array("No","C"),
                array("Nama","C"),
                array("Jumlah","C"),
                array("Stok","C"),
                array("Deskripsi","C")
    ));
foreach($troble as $data) {
    $no=1;
$pdf->SetFont('helvetica','',8);
    $pdf->Row1(array(
                array($no,"C"),
                array($data->Namabrg,"L"),
                array($data->Jumlhbrg,"C"),
                array($data->Stok,"C"),
                array($data->Deskripsi,"L")
    ));
    $no++;
}
$pdf->ln(10);
$pdf->Output("Rekap_Absensi.pdf","I");
?>