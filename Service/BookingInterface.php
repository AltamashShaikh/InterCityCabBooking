<?php

interface BookingInterface {
    public function addBooking($id, $cabObj, $sourceCity, $destinationCity, $sourceState, $destinationState, $status, $startDateTime, $endDateTime);
}
