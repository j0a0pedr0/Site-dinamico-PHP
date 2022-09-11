<?php
    ob_start();
    require  '../vendor/autoload.php';
    include('template-financeiro.php');
    $conteudo = ob_get_contents();
    ob_end_clean();

    // reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($conteudo);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();


?>