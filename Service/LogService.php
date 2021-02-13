<?php

require_once '/var/www/html/MachineCode/InterCityCabBooking/Model/Log.php';
require_once 'LogInterface.php';

class LogService implements LogInterface {
    public $logs = [];

    public function log($logType = '', $data = array()) {
        $logObj = new Log();
        $logObj->setLogType($logType);
        $logObj->setData($data);
        $this->logs[$logType][] = $logObj;

        return $logObj;
    }
}
