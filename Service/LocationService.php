<?php

require_once '/var/www/html/MachineCode/InterCityCabBooking/Model/Location.php';
require_once 'LocationInterface.php';

class LocationService implements LocationInterface {
    public $locations = array();

    public function addLocation($id, $city, $state) {
        $locationObj = new Location();
        $locationObj->setId($id);
        $locationObj->setCity($city);
        $locationObj->setState($state);

        $this->locations[$id] = $locationObj;

        return $this->locations[$id];
    }
}
