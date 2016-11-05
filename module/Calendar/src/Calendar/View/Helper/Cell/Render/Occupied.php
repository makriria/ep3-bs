<?php

namespace Calendar\View\Helper\Cell\Render;

use Square\Entity\Square;
use Zend\View\Helper\AbstractHelper;

class Occupied extends AbstractHelper
{

    public function __invoke($user, $userBooking, array $reservations, array $cellLinkParams, Square $square)
    {
        //print_r($reservations[$user->get('uid')]);
        //try{
        //var_dump($userBooking->need('meta'));
        //} catch(\Exception $e){}
        //var_dump($reservations[$user->get('uid')]);
        $view = $this->getView();

        if ($user && $user->can('calendar.see-data')) {

            return $view->calendarCellRenderOccupiedForPrivileged($reservations, $cellLinkParams);
        } else if ($user) {
            if ($userBooking) {
                $my_meta = ($userBooking->need('meta'));
                if (isset($my_meta['player-names'])) {
                    $my_opponent = unserialize($my_meta['player-names']);
                    $my_opponent_name = $my_opponent[0]['value'];
                    $cellLabel = $user->get('alias').' - '.$my_opponent_name;
                } else {
                    $cellLabel = $view->t('Your Booking');
                }

                $cellGroup = ' cc-group-' . $userBooking->need('bid');

                return $view->calendarCellLink($cellLabel, $view->url('square', [], $cellLinkParams), 'cc-own' . $cellGroup);
            } else {
                return $view->calendarCellRenderOccupiedForVisitors($reservations, $cellLinkParams, $square, $user);
            }
        } else {
            return $view->calendarCellRenderOccupiedForVisitors($reservations, $cellLinkParams, $square);
        }
    }

}
