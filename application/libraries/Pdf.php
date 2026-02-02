<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// LOAD AUTOLOAD DOMPDF (SESUIAI STRUKTUR KAMU)
require_once APPPATH . 'libraries/dompdf-master/vendor/autoload.php';

use Dompdf\Dompdf;

class Pdf
{
    public function generate($html, $filename = 'document', $paper = 'A4', $orientation = 'portrait')
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $dompdf->stream($filename, ['Attachment' => true]);
    }
}
