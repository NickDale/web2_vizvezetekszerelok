<?php
require_once('service/tcpdf/tcpdf.php');
define('CREATORS', 'Balogh Norbert (I2I25Q) & Farkas Tibor (EBZMXO)');

class PdfCreator
{
    private TCPDF $pdf;
    public function __construct()
    {
        $this->init();
    }

    private function init()
    {
        $this->pdf = new TCPDF(
            PDF_PAGE_ORIENTATION,
            PDF_UNIT,
            PDF_PAGE_FORMAT,
            true,
            'UTF-8',
            false
        );
        $this->pdf->SetCreator(PDF_CREATOR);
        $this->pdf->SetAuthor(CREATORS);
        $this->pdf->SetSubject('Web-programozás II - TCPDF');
        $this->pdf->SetTitle('Munkalapok');
        $this->pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $this->pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $this->pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $this->pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $this->pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $this->pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $this->pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $this->pdf->SetFont('helvetica', '', 10);
        $this->pdf->SetHeaderData(
            "nje.png",
            25,
            "Munkalapok",
            "Web-programozás II\n 2. beadandó\r\n" . date('Y.m.d', time())
        );
    }

    public function createPdf(array $munkalapok, string $fileName = 'munkalapok.pdf')
    {
        $this->pdf->AddPage();
        $this->pdf->writeHTML($this->createHtml($munkalapok), true, false, true, false, '');

        $pdfContent = $this->pdf->Output("munkalapok" . date('Y.m.d', time()) . ".pdf", 'S');
        file_put_contents($fileName, $pdfContent);
    }

    private function createHtml(array $munkalapok): string
    {
        $html  = '
                <html>
                    <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                        <style>
                            table {
                                font-family: arial, sans-serif;
                                border-collapse: collapse;
                                width: 100%;
                            }
                            td, th {
                                border: 1px solid #dddddd;
                                text-align: left;
                                padding: 8px;
                            }
                            tr:nth-child(even) {
                                background-color: #dddddd;
                            }
                        </style>
                    </head>
                    <body>
                        <h1 style="text-align: center;">Munkalapok</h1>
                        <table>
                        <thead>
                        <tr>
                            <th>Munkalap azonosító</th>
                            <th>Település</th>
                            <th>Utca</th>
                            <th>Beadás dátuma</th>
                            <th>Szerelő</th>
                            <th>Javítás dátuma</th>
                            <th>Munkaóra</th>
                            <th>Anyagár</th>
                        </tr>
                    </thead>
                    <tbody>
                ';
        foreach ($munkalapok as $ml) {
            $html .= '<tr>';
            $html .= '<td>' . $ml->getMunkaLapId() . '</td>';
            $html .= '<td>' . $ml->getTelepules() . '</td>';
            $html .= '<td>' . $ml->getUtca() . '</td>';
            $html .= '<td>' . $ml->getBeadasDatuma() . '</td>';
            $html .= '<td>' . $ml->getSzereloNeve() . '</td>';
            $html .= '<td>' . $ml->getJavitasDatuma() . '</td>';
            $html .= '<td>' . $ml->getMunkaora() . '</td>';
            $html .= '<td>' . $ml->getAnyagar() . '</td>';
            $html .= '</tr>';
        }
        $html .= '<tbody>
                </table>
            <body>
        </html>';

        return $html;
    }
}
