<?php

class Role {
    private $name;
    private $isRequired;

    public function __construct(string $name, bool $isRequired) {
        $this->name = $name;
        $this->isRequired = $isRequired;
    }

    public function getName() {
        return $this->name;
    }

    public function isRequired() {
        return $this->isRequired;
    }
}