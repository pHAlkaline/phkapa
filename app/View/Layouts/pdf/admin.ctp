<?php

require_once(ROOT . DS . 'vendors' . DS . 'dompdf' . DS . 'dompdf_config.inc.php');
spl_autoload_register('DOMPDF_autoload');

$pdf = new DOMPDF();
$pdf->set_paper = 'A4';

$pdf->load_html($content_for_layout, Configure::read('App.encoding'));

$pdf->render();

$pdf->stream(__('Ticket').$ticket['Ticket']['id'] . ".pdf", array("Attachment" => 0));
//echo $dompdf->output();
?>