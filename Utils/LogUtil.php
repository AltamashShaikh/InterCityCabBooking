<?php

require_once '/var/www/html/MachineCode/InterCityCabBooking/Service/LogService.php';

class LogUtil {
    public static $logService;

    public static function log($logType, $data) {
        if (is_null(self::$logService)) {
            self::$logService = new LogService();
        }

        return self::$logService->log($logType, $data);
    }

    public static function getLoggedData($type){
        if(!empty(self::$logService->logs[$type])){
            return self::$logService->logs[$type];
        }
        return [];
    }
}
