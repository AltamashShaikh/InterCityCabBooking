<?php

class Cab {
    private $id;
    private $locationObj;
    private $status = 'idle';

    /**
     * @param mixed $locationObj
     */
    public function setLocationObj($locationObj) {
        $this->locationObj = $locationObj;
    }

    /**
     * @return mixed
     */
    public function getLocationObj() {
        return $this->locationObj;
    }

    /**
     * @param mixed $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status) {
        $this->status = $status;
    }
}
