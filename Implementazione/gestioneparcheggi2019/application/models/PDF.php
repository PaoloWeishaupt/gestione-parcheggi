<?php


namespace Models;

use Libs\FPDF\FPDF as FPDF;

class PDF extends FPDF
{

    public static $pdf;

    public static function cretePDF($parcheggio, $riservazione)
    {
        self::$pdf = new FPDF();
        self::$pdf->AddPage();
        self::$pdf->SetFont('Arial','B',13);
        self::$pdf->Cell(60,10,'Dati della riservazione');

        $header = array('ID prenotazione', 'Data prenotazione', 'Disponibilita', 'Data disponibilita');
        self::createTable($header, $parcheggio, $riservazione);
        return self::$pdf->Output('S');
    }

    public static function createTable($header, $parcheggio, $riservazione)
    {
        $dateFormat = date_format(date_create($parcheggio['data_disp']), 'd-m-Y');
        $prenDateFormat = date_format(date_create($riservazione['data_prenotazione']), 'd-m-Y');

        // Va a capo
        self::$pdf->Ln(10);
        // Larghezza delle colonne
        $w = array(45, 45, 45, 45);
        // Header della tabella
        self::$pdf->SetFont('Arial','B',12);
        for($i=0;$i<count($header);$i++)
            self::$pdf->Cell($w[$i],7,$header[$i],1,0,'C');
        self::$pdf->Ln();
        // Font del body
        self::$pdf->SetFont('Arial','B',10);
        // Dati
        self::$pdf->Cell($w[0],6,$riservazione['id'],'LR');
        self::$pdf->Cell($w[1],6,$prenDateFormat,'LR');
        self::$pdf->Cell($w[2],6,$parcheggio['disponibilita'],'LR',0,'R');
        self::$pdf->Cell($w[3],6,$dateFormat,'LR',0,'R');
        self::$pdf->Ln();

        // Chiusura della riga
        self::$pdf->Cell(array_sum($w),0,'','T');
    }
}