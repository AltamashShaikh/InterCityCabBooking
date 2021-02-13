<?php

class Log {
    private $logType;
    private $data;

    /**
     * @return mixed
     */
    public function getLogType() {
        return $this->logType;
    }

    /**
     * @param mixed $logType
     */
    public function setLogType($logType) {
        $this->logType = $logType;
    }

    /**
     * @return mixed
     */
    public function getData() {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data) {
        $this->data = $data;
    }
}
