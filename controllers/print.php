<?php

require_once 'service/pdf_creator.php';
require_once 'models/munkalap_model.php';
require_once 'models/munkalap.php';

class Print_Controller
{
    public function print($munkaLapok)
    {
        $pdfCreator = new PdfCreator();
        $pdfCreator->createPdf($munkaLapok);
    }
}
