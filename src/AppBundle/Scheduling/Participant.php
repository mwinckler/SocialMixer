<?php

class Participant {
    private $name;
    private $preferences;

/*
    public function __construct(string $name, string $preferences) {
        $this->name = $name;
        $this->preferences = self::parsePreferences($preferences);
    }
*/

    static function parseParticipantDefinition(string $definition) {
        $participant = new Participant();
        // Format:
        //
        // Name with spaces (EventName:+Role;EventName2:-Role)
        //
        // Only participant name is required.

        $matches = array();
        preg_match('/(?P<participantName>[^(]+)(?P<rolePrefs>\([^)]+\))?/', $definition, $matches);

        $participant->name = $matches['participantName'];
        $participant->preferences = Participant::parsePreferences($matches['rolePrefs']);

        return $participant;
    }

    static function parsePreferences(string $preferences) {
        $ret = array();
        $prefs = explode(';', $preferences);

        foreach ($prefs as $eventPref) {
            $matches = array();
            $success = preg_match('/([-]?)([^:]+)(:(?P<rolePrefs>.*))?/', $eventPref, $matches);
            $eventName = $matches[2];

            if ($match[1] == '-') {
                // Cannot attend the named event
                $ret[$eventName] = false;
                continue;
            }

            $ret[$eventName] = array();

            // Let us all shed a tear for PHP's lack of repeating regex captures. T_T
            var $rolePrefs = preg_split('/([-+])/', $rolePrefs, -1, PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY);

            for ($i = 0; i < count($rolePrefs), $i += 2) {
                $roleName = $rolePrefs[$i+1];
                $canFill = $rolePrefs[$i] === "+";
                $ret[$eventName][$roleName]] = $canFill;
            }
        }

        return $ret;
    }

    public static function canAttend(Participant $participant, string $eventId, string $role = null) {
        if (!in_array($eventId, $participant->preferences)) {
            return true;
        }

        $eventPrefs = $participant->preferences[$eventId];

        if ($eventPrefs === false) {
            return false;
        }

        return $role === null || $eventPrefs[$role];
    }

    public function getName() {
        return $this->name;
    }
}