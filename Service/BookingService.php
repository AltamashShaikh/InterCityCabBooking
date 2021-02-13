<?php

require_once 'BookingInterface.php';
require_once '/var/www/html/MachineCode/InterCityCabBooking/Model/Booking.php';

class BookingService implements BookingInterface {
    public $bookings = [];

    public function addBooking($id, $cabObj, $sourceCity, $destinationCity, $sourceState, $destinationState, $status, $startDateTime, $endDateTime = null) {
        if (!empty($this->bookings[$cabObj->getId()][$id])) {
            throw new Exception('Booking Already Exist');
        }
        $bookingObj = new Booking();
        $bookingObj->setId($id);
        $bookingObj->setCabObj($cabObj);
        $bookingObj->setSourceCity($sourceCity);
        $bookingObj->setDestinationCity($destinationCity);
        $bookingObj->setSourceState($sourceState);
        $bookingObj->setDestinationState($destinationState);
        $bookingObj->setStatus('in_trip');
        $bookingObj->setStartDateTime($startDateTime);
        $bookingObj->setEndDateTime($endDateTime);
        $this->bookings[$cabObj->getId()][$id] = $bookingObj;

        return $this->bookings[$cabObj->getId()][$id];
    }
}
