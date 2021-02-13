<?php

require_once '/var/www/html/MachineCode/InterCityCabBooking/Service/CabService.php';

class CabsController {
    private $cabService;

    public function __construct() {
        $this->cabService = new CabService();
    }

    public function addCab($id, $locationObj) {
        return $this->cabService->addCab($id, $locationObj);
    }

    public function listAllCabs() {
        foreach ($this->cabService->cabs as $cab) {
            if ($cab->getstatus() == 'idle') {
                $city = $cab->getLocationObj()->getCity();
            } else {
                $city = 'indeterminate';
            }
            echo $cab->getId() . ',' . $city . PHP_EOL;
        }
    }

    public function bookCab($source, $destination, $state, $bookingsControllerObject) {
        LogUtil::log('cityWiseRequests', ['requestTime' => date('Y-m-d H:i:s'), 'sourceCity' => $source, 'destinationCity' => $destination, 'state' => $state]);
        $idleCabs = $this->getIdleCabsInACity($source, $state);
        if (empty($idleCabs)) {
            return array('status' => 'falure', 'message' => 'No cabs available at the moment!');
        }

        $idleCabTimes = $bookingsControllerObject->getCabsIdleTime($idleCabs);

        $firstKey = key($idleCabTimes);
        $bookingID = uniqid();

        $this->cabService->cabs[$firstKey]->setStatus('in_trip');
        $booking = $bookingsControllerObject->addBooking($bookingID, $this->cabService->cabs[$firstKey], $source, $destination, $state, $state, 'trip_in_progress', date('Y-m-d H:i:s'));

        return array('status' => 'success', 'bookingInfo' => $booking);
    }

    private function getIdleCabsInACity($sourceCity, $state) {
        $ids = [];
        foreach ($this->cabService->cabs as $id => $cab) {
            if (
                $cab->getLocationObj()->getCity() == $sourceCity &&
                $cab->getLocationObj()->getState() == $state &&
                $cab->getstatus() == 'idle'
            ) {
                $ids[] = $id;
            }
        }

        return $ids;
    }

    public function updateState($cabId, $locationObject, $cabHistoryObject) {
        if ($this->cabService->cabs[$cabId]->getStatus() !== 'idle') {
            return array('status' => 'failure', 'message' => 'Cab not idle');
        }

        $this->cabService->cabs[$cabId]->setLocationObj($locationObject);

        $cabHistoryObject->addState($this->cabService->cabs[$cabId], $locationObject->getState());

        return array('status' => 'success', 'message' => 'Location updated successfully', 'cab' => $this->cabService->cabs[$cabId]);
    }

    public function getIdleTimeInSeconds($cabId, $startDateTime, $endDateTime, $bookingObject) {
        $dateDiffInSeconds = $this->getDateDiffInSeconds($startDateTime, $endDateTime) - $bookingObject->getDurationInSeconds($cabId, $startDateTime, $endDateTime);

        return $dateDiffInSeconds;
    }

    private function getDateDiffInSeconds($date1, $date2) {
        return strtotime($date2) - strtotime($date1);
    }
}
