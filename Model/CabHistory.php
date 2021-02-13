<?php

class CabHistory {
    public $statesTravelled = [];

    /**
     * @return array
     */
    public function getStatesTravelled() {
        return $this->statesTravelled;
    }

    /**
     * @param array $statesTravelled
     */
    public function setStatesTravelled($statesTravelled) {
        $this->statesTravelled = $statesTravelled;
    }

    public function addState($state) {
        if (!isset($this->statesTravelled[$state])) {
            $this->statesTravelled[$state] = $state;
        }
    }
}
