<?php

require_once(ROOT . DS . 'vendors' . DS . 'dompdf' . DS . 'dompdf_config.inc.php');
spl_autoload_register('DOMPDF_autoload');

$pdf = new DOMPDF();
$pdf->set_paper = 'A4';
$content=iconv(mb_detect_encoding($content_for_layout, mb_detect_order(), true), "UTF-8", $content_for_layout);
$pdf->load_html($content, Configure::read('App.encoding'));

$pdf->render();
//$pdf->stream(__('Ticket').$ticket['Ticket']['id'] . ".pdf", array("Attachment" => false));
echo $pdf->output();
?>