<?php

require_once 'service/pdf_creator.php';

class Print_Controller
{
    private $baseName = 'print';
    public function main(array $vars)
    {

        print_r("PDF creator Controller");
        $munkaLapModel = new Munkalap_Model;

        $pdfCreator = new PdfCreator();
        $pdfCreator->createPdf($munkaLapModel->munkalapok());
    }
}
