<?php

namespace Calendar\View\Helper\Cell\Render;

use Booking\Service\BookingStatusService;
use Zend\View\Helper\AbstractHelper;

class OccupiedForPrivileged extends AbstractHelper
{

    protected $bookingStatusService;

    public function __construct(BookingStatusService $bookingStatusService)
    {
        $this->bookingStatusService = $bookingStatusService;
    }

    public function __invoke(array $reservations, array $cellLinkParams)
    {
        $view = $this->getView();
        //var_dump($reservations[$user->get('uid')]);
        $reservationsCount = count($reservations);
        if ($reservationsCount > 1) {
            return $view->calendarCellLink($this->view->t('Occupied'), $view->url('backend/booking/edit', [], $cellLinkParams), 'cc-single');
        } else {
            $reservation = current($reservations);
            $booking = $reservation->needExtra('booking');
            $bookingStatusColor = $this->bookingStatusService->getStatusColor($booking->getBillingStatus());

            if ($bookingStatusColor) {
                $cellStyle = 'outline: solid 3px ' . $bookingStatusColor;
            } else {
                $cellStyle = null;
            }


            $my_meta = ($booking->need('meta'));
            if (isset($my_meta['player-names'])) {
                $my_opponent = unserialize($my_meta['player-names']);
                $my_opponent_name = $my_opponent[0]['value'];
                $cellLabel = $booking->needExtra('user')->need('alias').' - '.$my_opponent_name;
            } else {
                $cellLabel = $booking->needExtra('user')->need('alias');
            }

            //$cellLabel = $booking->needExtra('user')->need('alias');
            $cellGroup = ' cc-group-' . $booking->need('bid');
            switch ($booking->need('status')) {
                case 'single':
                    return $view->calendarCellLink($cellLabel, $view->url('backend/booking/edit', [], $cellLinkParams), 'cc-single' . $cellGroup, null, $cellStyle);
                case 'subscription':
                    return $view->calendarCellLink($cellLabel, $view->url('backend/booking/edit', [], $cellLinkParams), 'cc-multiple' . $cellGroup, null, $cellStyle);
            }
        }
    }

}
