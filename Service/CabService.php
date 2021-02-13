<?php
require_once 'CabInterface.php';
require_once '/var/www/html/MachineCode/InterCityCabBooking/Model/Cab.php';

class CabService implements CabInterface {
    public $cabs = [];

    public function addCab($id, $locationObj) {
        if(!empty($this->cabs[$id])){
            throw new Exception('Cab Already Registered');
        }

        $cabObj = new Cab();
        $cabObj->setId($id);
        $cabObj->setLocationObj($locationObj);
        $this->cabs[$id] = $cabObj;

        return $this->cabs[$id];
    }
}
