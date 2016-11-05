<?php

namespace Calendar\View\Helper\Cell\Render;

use Square\Entity\Square;
use Zend\View\Helper\AbstractHelper;

class OccupiedForVisitors extends AbstractHelper
{

    public function __invoke(array $reservations, array $cellLinkParams, Square $square, $user = null)
    {
        $view = $this->getView();

        $reservationsCount = count($reservations);

        if ($reservationsCount > 1) {
            return $view->calendarCellLink($this->view->t('Occupied'), $view->url('square', [], $cellLinkParams), 'cc-single');
        } else {
            $reservation = current($reservations);
            $booking = $reservation->needExtra('booking');


            $my_meta = ($booking->need('meta'));
            if (isset($my_meta['player-names'])) {
                $my_opponent = unserialize($my_meta['player-names']);
                $my_opponent_name = $my_opponent[0]['value'];
            } else {
                $my_opponent_name ='';
            }

            if ($square->getMeta('public_names', 'false') == 'true') {
                if ($my_opponent_name) {
                    $cellLabel = $booking->needExtra('user')->need('alias').' - '.$my_opponent_name;
                } else {
                    $cellLabel = $booking->needExtra('user')->need('alias');
                }

            } else if ($square->getMeta('private_names', 'false') == 'true' && $user) {
                if ($my_opponent_name) {
                    $cellLabel = $booking->needExtra('user')->need('alias').' - '.$my_opponent_name;
                } else {
                    $cellLabel = $booking->needExtra('user')->need('alias');
                }
            } else {
                $cellLabel = null;
            }

            $cellGroup = ' cc-group-' . $booking->need('bid');

            switch ($booking->need('status')) {
                case 'single':
                    if (! $cellLabel) {
                        $cellLabel = $this->view->t('Occupied');
                    }

                    return $view->calendarCellLink($cellLabel, $view->url('square', [], $cellLinkParams), 'cc-single' . $cellGroup);
                case 'subscription':
                    if (! $cellLabel) {
                        $cellLabel = $this->view->t('Subscription');
                    }

                    return $view->calendarCellLink($cellLabel, $view->url('square', [], $cellLinkParams), 'cc-multiple' . $cellGroup);
            }
        }
    }

}
