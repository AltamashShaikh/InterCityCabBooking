<?php

class Booking {
    private $id;
    private $cabObj;
    private $sourceCity;
    private $destinationCity;
    private $sourceState;
    private $destinationState;
    private $status;
    private $startDateTime;
    private $endDateTime;

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
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
    public function getCabObj() {
        return $this->cabObj;
    }

    /**
     * @param mixed $cabObj
     */
    public function setCabObj($cabObj) {
        $this->cabObj = $cabObj;
    }

    /**
     * @return mixed
     */
    public function getSourceCity() {
        return $this->sourceCity;
    }

    /**
     * @param mixed $sourceCity
     */
    public function setSourceCity($sourceCity) {
        $this->sourceCity = $sourceCity;
    }

    /**
     * @return mixed
     */
    public function getDestinationCity() {
        return $this->destinationCity;
    }

    /**
     * @param mixed $destinationCity
     */
    public function setDestinationCity($destinationCity) {
        $this->destinationCity = $destinationCity;
    }

    /**
     * @return mixed
     */
    public function getSourceState() {
        return $this->sourceState;
    }

    /**
     * @param mixed $sourceState
     */
    public function setSourceState($sourceState) {
        $this->sourceState = $sourceState;
    }

    /**
     * @return mixed
     */
    public function getDestinationState() {
        return $this->destinationState;
    }

    /**
     * @param mixed $destinationState
     */
    public function setDestinationState($destinationState) {
        $this->destinationState = $destinationState;
    }

    /**
     * @return mixed
     */
    public function getStartDateTime() {
        return $this->startDateTime;
    }

    /**
     * @param mixed $startDateTime
     */
    public function setStartDateTime($startDateTime) {
        $this->startDateTime = $startDateTime;
    }

    /**
     * @return mixed
     */
    public function getEndDateTime() {
        return $this->endDateTime;
    }

    /**
     * @param mixed $endDateTime
     */
    public function setEndDateTime($endDateTime) {
        $this->endDateTime = $endDateTime;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status) {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getStatus() {
        return $this->status;
    }
}
