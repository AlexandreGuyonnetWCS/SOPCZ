<?php

namespace App\Service;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfService
{
    private Dompdf $domPdf;

    public function __construct()
    {
        $this->domPdf = new Dompdf();

        $pdfOptions = new Options();
        $pdfOptions->setDefaultPaperSize('A4');
        $pdfOptions->set('isHtml5ParserEnabled', true);
        $pdfOptions->setChroot(__DIR__ . '/../../public');
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
}
