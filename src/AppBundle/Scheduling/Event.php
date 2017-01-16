<?php

class Event {
    private $groups;

    public function __construct() {
        $this->groups = array();
    }

    public function addGroup(EventGroup $group) {
        $this->groups[] = $group;
    }
}
