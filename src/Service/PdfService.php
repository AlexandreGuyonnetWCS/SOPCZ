<?php

namespace App\Service;

use Dompdf\Dompdf;
use Dompdf\Options;
use Spatie\PdfToImage\Pdf;

class PdfService
{
    private Dompdf $domPdf;

    public function __construct()
    {
        $this->domPdf = new Dompdf();

        $pdfOptions = new Options();
        $pdfOptions->setDefaultPaperSize('A4');
        $pdfOptions->set('isHtml5ParserEnabled', true);
        $pdfOptions->setDpi(300);

        $this->domPdf->setOptions($pdfOptions);
    }

    public function showPdfFile(string $html): void
    {
        $this->domPdf->loadHtml($html);
        $this->domPdf->render();
        $this->domPdf->stream("carte.pdf");
    }

    public function generateBinaryPDF(string $html): void
    {
        $this->domPdf->loadHtml($html);
        $this->domPdf->render();
        $this->domPdf->stream("carte.pdf", [
            'Attachment' => true,
        ]);
    }

    // convertir pdf en image avec Spatie

    // public function convertPdfToImage(string $pdf): void
    // {
    //     $pdf = new Pdf($pdf);
    //     $pdf->setResolution(100);
    //     $pdf->setPage(1)->saveImage('public/uploads/employes/ . employe->getdocument() . .png');
    // }
}
