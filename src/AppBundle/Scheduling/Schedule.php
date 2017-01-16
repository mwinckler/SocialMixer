<?php

class Schedule {
    private $events;

    public function __construct() {
        $this->events = array();
    }

    public function schedule($eventNames, $desiredGroupSize, $roles, $participants) {
        function sortRoles(Role $a, Role $b) {
            return $a.isRequired() ? -1 : 1;
        }

        foreach ($eventNames as $eventName) {
            $groupParticipantList = array_filter($participants, function($p) { return Participant::canAttend($p, $eventName); });
            $groups = array();
            for ($i = 0; i < ceil($participants / $desiredGroupSize); i++) {
                $groups[] = new EventGroup();
            }

            // Sort roles by isRequired, then by number of participants willing to take it
            usort($roles, sortRoles);

            foreach ($roles as $role) {

            }
        }
    }
}