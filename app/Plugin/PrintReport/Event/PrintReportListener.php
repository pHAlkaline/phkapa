<?php

App::uses('CakeEventListener', 'Event');


/**
 * Description of AddressListener
 *
 * @author paulo
 */
class PrintReportListener implements CakeEventListener {

    public function implementedEvents() {
        return array(
            'Phkapa.Ticket.PrintReport' => 'printReport',
            'Phkapa.Ticket.PdfReport' => 'printReport'
        );
    }

    public function printReport(CakeEvent $event) {
        
        $event->subject()->Ticket->recursive = 2;
        $event->subject()->set('ticket', $event->subject()->Ticket->read(null, $event->data['id']));
        $event->subject()->render('PrintReport.print_report','PrintReport.print');

    }

}
