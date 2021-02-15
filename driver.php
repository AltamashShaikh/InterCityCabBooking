<?php

require_once 'Controller/CabsController.php';
require_once 'Controller/BookingsController.php';
require_once 'Controller/LocationsController.php';
require_once 'Controller/CabHistoryController.php';
require_once 'Utils/LogUtil.php';
require_once 'Utils/CommonUtils.php';

$cabsControllerObject = new CabsController();
$bookingsControllerObject = new BookingsController();
$locationsControllerObject = new LocationsController();
$cabHistoryObject = new CabHistoryController();

echo '***************** Registering Locations ******************' . PHP_EOL;

$location1 = $locationsControllerObject->addLocation(1, 'mumbai', 'mh');
$location2 = $locationsControllerObject->addLocation(2, 'pune', 'mh');
$location3 = $locationsControllerObject->addLocation(3, 'bangalore', 'ka');
$location4 = $locationsControllerObject->addLocation(4, 'hyderabad', 'ts');

echo '***************** Locations Registered******************' . PHP_EOL;

echo '***************** Available Locations******************' . PHP_EOL;
$locationsControllerObject->listAllLocations();
echo '********************************************************' . PHP_EOL;


echo '***************** Registering Cabs ******************' . PHP_EOL;

$cab1 = $cabsControllerObject->addCab('Mh-02-AA', $location1);
$cabHistoryObject->addState($cab1, $location1->getState());

$cab2 = $cabsControllerObject->addCab('Mh-02-XX', $location1);
$cabHistoryObject->addState($cab2, $location1->getState());

$cab3 = $cabsControllerObject->addCab('Mh-02-BB', $location2);
$cabHistoryObject->addState($cab3, $location3->getState());

$cab4 = $cabsControllerObject->addCab('KA-02-AA', $location3);
$cabHistoryObject->addState($cab4, $location3->getState());

$cab5 = $cabsControllerObject->addCab('KA-02-BB', $location3);
$cabHistoryObject->addState($cab5, $location3->getState());

$cab6 = $cabsControllerObject->addCab('TS-02-AA', $location4);
$cabHistoryObject->addState($cab6, $location4->getState());

$cab7 = $cabsControllerObject->addCab('TS-02-BB', $location4);
$cabHistoryObject->addState($cab7, $location4->getState());

echo '***************** Cabs Registration Complete ******************' . PHP_EOL;

echo '***************** Available Cabs******************' . PHP_EOL;
$cabsControllerObject->listAllCabs();
echo '********************************************************' . PHP_EOL;


echo 'Book a cab between Mumbai - Pune(booking1) for 19th Feb 2021' . PHP_EOL;
$info = $cabsControllerObject->bookCab('mumbai', 'pune', 'mh', $bookingsControllerObject, '19/02/2021');
if ($info['status'] == 'success') {
    $booking1 = $info['bookingInfo'];
    echo 'Cab booked between Mumbai - Pune(booking1) - Booking ID: ' . $booking1->getId() . ', Cab No: ' . $booking1->getCabObj()->getId() . PHP_EOL;
} else {
    echo 'Unable to book any cabs: ' . $info['message'] . PHP_EOL;
}

//----------------

echo 'Book a cab between Mumbai - Pune(booking2)' . PHP_EOL;
$info = $cabsControllerObject->bookCab('mumbai', 'pune', 'mh', $bookingsControllerObject);
if ($info['status'] == 'success') {
    $booking2 = $info['bookingInfo'];
    echo 'Cab booked between Mumbai - Pune(booking2) - Booking ID: ' . $booking2->getId() . ', Cab No: ' . $booking2->getCabObj()->getId() . PHP_EOL;
} else {
    echo 'Unable to book any cabs: ' . $info['message'] . PHP_EOL;
}

// -------------------
echo 'Book a cab between Mumbai - Pune(booking3)' . PHP_EOL;
$info = $cabsControllerObject->bookCab('mumbai', 'pune', 'mh', $bookingsControllerObject);
if ($info['status'] == 'success') {
    $booking3 = $info['bookingInfo'];
    echo 'Cab booked between Mumbai - Pune(booking3) - Booking ID: ' . $booking3->getId() . ', Cab No: ' . $booking3->getCabObj()->getId() . PHP_EOL;
} else {
    echo 'Unable to book any cabs: ' . $info['message'] . PHP_EOL;
}

echo '***************** Available Cabs******************' . PHP_EOL;
$cabsControllerObject->listAllCabs();
echo '********************************************************' . PHP_EOL;


echo '***************** Mark Booking Complete of booking 2 ************' . PHP_EOL;
$bookingsControllerObject->completeBooking($booking2, $location2, $cabHistoryObject);
echo '********************************************************' . PHP_EOL;

sleep(5);

echo '***************** Mark Booking Complete of booking 1 ************' . PHP_EOL;
$bookingsControllerObject->completeBooking($booking1, $location2, $cabHistoryObject);
echo '********************************************************' . PHP_EOL;

echo '***************** Available Cabs******************' . PHP_EOL;
$cabsControllerObject->listAllCabs();
echo '********************************************************' . PHP_EOL;


echo 'Book a cab between Pune - Mumbai (booking 4)' . PHP_EOL;
$info = $cabsControllerObject->bookCab('pune', 'mumbai', 'mh', $bookingsControllerObject);
if ($info['status'] == 'success') {
    $booking4 = $info['bookingInfo'];
    echo 'Cab booked between Mumbai - Pune(booking3) - Booking ID: ' . $booking4->getId() . ', Cab No: ' . $booking4->getCabObj()->getId() . PHP_EOL;
} else {
    echo 'Unable to book any cabs: ' . $info['message'] . PHP_EOL;
}


echo 'Book a cab between Pune - Mumbai (booking 5)' . PHP_EOL;
$info = $cabsControllerObject->bookCab('pune', 'mumbai', 'mh', $bookingsControllerObject);
if ($info['status'] == 'success') {
    $booking5 = $info['bookingInfo'];
    echo 'Cab booked between Mumbai - Pune(booking3) - Booking ID: ' . $booking5->getId() . ', Cab No: ' . $booking5->getCabObj()->getId() . PHP_EOL;
} else {
    echo 'Unable to book any cabs: ' . $info['message'] . PHP_EOL;
}

$cabsControllerObject->updateState($cab1->getId(), $location3, $cabHistoryObject);
echo '***************** Available Cabs******************' . PHP_EOL;
$cabsControllerObject->listAllCabs();
echo '********************************************************' . PHP_EOL;

echo '***************** Cab2 Idle time for today******************' . PHP_EOL;
echo $cabsControllerObject->getIdleTimeInSeconds($cab2->getId(), date('Y-m-d') . ' 00:00:00', date('Y-m-d H:i:s'), $bookingsControllerObject) . ' seconds' . PHP_EOL;
echo '********************************************************' . PHP_EOL;

echo '***************** Cab6 Idle time for today******************' . PHP_EOL;
echo $cabsControllerObject->getIdleTimeInSeconds($cab6->getId(), date('Y-m-d') . ' 00:00:00', date('Y-m-d H:i:s'), $bookingsControllerObject) . ' seconds' . PHP_EOL;
echo '********************************************************' . PHP_EOL;


echo '***************** Get Cab History by state for Cab1 ******************' . PHP_EOL;
echo implode(',', $cabHistoryObject->getAllStates($cab1)) . PHP_EOL;
echo '********************************************************' . PHP_EOL;

echo '***************** Cities With High Demand ******************' . PHP_EOL;
$loggedData = LogUtil::getLoggedData('cityWiseRequests');
print_r(CommonUtils::groupDataByCity($loggedData));
echo '********************************************************' . PHP_EOL;

echo '***************** Cities With High Demand and Time ******************' . PHP_EOL;
$loggedData = LogUtil::getLoggedData('cityWiseRequests');
print_r(CommonUtils::groupDataByCityAndTime($loggedData));
echo '********************************************************' . PHP_EOL;

