<?php

require_once '/var/www/html/MachineCode/InterCityCabBooking/Service/CabHistoryService.php';

class CabHistoryController {
    public $cabHistoryService;

    public function __construct() {
        $this->cabHistoryService = new CabHistoryService();
    }

    public function addState($cabObj, $state) {
        return $this->cabHistoryService->addState($cabObj, $state);
    }

    public function getAllStates($cabObj) {
        if (!empty($this->cabHistoryService->cabhistory[$cabObj->getId()])) {
            return $this->cabHistoryService->cabhistory[$cabObj->getId()]->getStatesTravelled();
        }

        return [];
    }
}
