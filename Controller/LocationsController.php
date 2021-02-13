<?php
require_once '/var/www/html/MachineCode/InterCityCabBooking/Service/LocationService.php';

class LocationsController {
    private $locationService;

    public function __construct() {
        $this->locationService = new LocationService();
    }

    public function addLocation($id, $city, $state) {
        return $this->locationService->addLocation($id, $city, $state);
    }

    public function listAllLocations() {
        foreach ($this->locationService->locations as $location) {
            echo $location->getId() . ',' . $location->getCity() . ',' . $location->getState() . PHP_EOL;
        }
    }
}
