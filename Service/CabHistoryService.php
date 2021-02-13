<?php

require_once '/var/www/html/MachineCode/InterCityCabBooking/Model/CabHistory.php';
require_once 'CabHistoryInterface.php';

class CabHistoryService implements CabHistoryInterface {
    public $cabhistory = [];

    public function addState($cabObj, $state) {
        if (empty($this->cabhistory[$cabObj->getId()])) {
            $cabHistoryObj = new CabHistory();
            $cabHistoryObj->addState($state);
            $this->cabhistory[$cabObj->getId()] = $cabHistoryObj;
        } else {
            $this->cabhistory[$cabObj->getId()]->addState($state);
        }


        return $this->cabhistory[$cabObj->getId()];
    }
}
