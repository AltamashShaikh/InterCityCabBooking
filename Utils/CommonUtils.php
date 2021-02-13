<?php

class CommonUtils {

    public static function groupDataByCity($data) {
        $formattedData = [];
        foreach ($data as $v) {
            $logLine = $v->getData();
            if (empty($formattedData[$logLine['sourceCity']])) {
                $formattedData[$logLine['sourceCity']] = 0;
            }
            $formattedData[$logLine['sourceCity']]++;
        }

        arsort($formattedData);

        return $formattedData;
    }

    public static function groupDataByCityAndTime($data) {
        $formattedData = [];
        foreach ($data as $v) {
            $logLine = $v->getData();
            if (empty($formattedData[$logLine['sourceCity'] . '_' . $logLine['requestTime']])) {
                $formattedData[$logLine['sourceCity'] . '_' . $logLine['requestTime']] = 0;
            }
            $formattedData[$logLine['sourceCity'] . '_' . $logLine['requestTime']]++;
        }

        arsort($formattedData);

        return $formattedData;
    }
}
