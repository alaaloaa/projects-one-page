<?php

$user = 'alaa';


require 'vendor/autoload.php';

$data = json_decode(file_get_contents(__DIR__ . "/json/{$user}.json"), true);

if (!$data) {
  die('<h2 style="color: red; font-family: Arial; text-align: center">Json format is not valid!</h2>');
}

header('content-type: application/pdf');
// header('content-type: text/plain');

extract($data);

$file = file_get_contents(__DIR__ . '/content.php');
$file = str_replace(['{{', '}}'], ['<?php echo @', ';?>'], $file);
ob_start();
eval("?>$file");
$html = ob_get_contents();
ob_end_clean();

use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf([
  'enable_remote' => true
]);
$dompdf->set_option('isRemoteEnabled', TRUE);
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
// $dompdf->setPaper('A4', 'landscape');
$dompdf->setPaper('A4');

// Render the HTML as PDF
$dompdf->render();

echo $dompdf->output();

// Output the generated PDF to Browser
// $dompdf->stream();