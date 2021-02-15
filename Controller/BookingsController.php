<?php

require_once '/var/www/html/MachineCode/InterCityCabBooking/Service/BookingService.php';

class BookingsController {
    private $bookingService;

    public function __construct() {
        $this->bookingService = new BookingService();
    }

    public function addBooking($id, $cabObj, $sourceCity, $destinationCity, $sourceState, $destinationState, $status, $startDateTime) {
        return $this->bookingService->addBooking($id, $cabObj, $sourceCity, $destinationCity, $sourceState, $destinationState, $status, $startDateTime);
    }

    public function getCabsIdleTime($cabs) {
        $timeList = array();
        foreach ($cabs as $cabID) {
            if (empty($this->bookingService->bookings[$cabID])) {
                $time = 00;
            } else {
                end($this->bookingService->bookings[$cabID]);
                $lastKey = key($this->bookingService->bookings[$cabID]);
                $time = strtotime($this->bookingService->bookings[$cabID][$lastKey]->getEndDateTime()) - strtotime(date('Y-m-d H:i:s'));
            }
            $timeList[$cabID] = $time;
        }

        arsort($timeList);

        return $timeList;
    }

    public function completeBooking($bookingInfo, $newLocationObj, $cabHistoryObject) {
        $bookingId = $bookingInfo->getId();
        $cabID = $bookingInfo->getCabObj()->getId();
        //update booking as complete
        $this->bookingService->bookings[$cabID][$bookingId]->setStatus('trip_completed');
        $this->bookingService->bookings[$cabID][$bookingId]->setEndDateTime(date('Y-m-d H:i:s'));
        $this->bookingService->bookings[$cabID][$bookingId]->getCabObj()->setStatus('idle');
        $this->bookingService->bookings[$cabID][$bookingId]->getCabObj()->setLocationObj($newLocationObj);
        $cabHistoryObject->addState($bookingInfo->getCabObj(), $newLocationObj->getState());
    }

    public function getDurationInSeconds($cabId, $startDateTime, $endDateTime) {
        $seconds = 0;
        if (!empty($this->bookingService->bookings[$cabId])) {
            foreach ($this->bookingService->bookings[$cabId] as $booking) {
                if (strtotime($booking->getStartDateTime()) >= strtotime($startDateTime)) {
                    $endTime = ($booking->getEndDateTime() ? min(strtotime($endDateTime), strtotime($booking->getEndDateTime())) : strtotime($endDateTime));
                    $seconds = $seconds + ($endTime - strtotime($booking->getStartDateTime()));
                }
            }
        }

        return $seconds;
    }

    public function isBookingExists($cabId, $date) {
        if (!empty($this->bookingService->bookings[$cabId])) {
            foreach ($this->bookingService->bookings[$cabId] as $booking) {
                $startDate = date('Y-m-d', strtotime($booking->getStartDateTime()));
                if (
                    $startDate == $date
                ) {
                    return false;
                }
            }
        }

        return true;
    }
}
