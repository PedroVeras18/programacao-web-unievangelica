/*
* Curso de Engenharia de Software - UniEVANGÉLICA 
* Disciplina de Programação Web 
* Dev: Pedro Henrique Veras
* Data: 20/06/24
*/ 

<!-- Open Closed Principle -->

<?php

class ElectricCar extends Car {
    private $batteryCapacity;
    private $range;

    public function __construct($make, $model, $year, $batteryCapacity, $range) {
        parent::__construct($make, $model, $year);
        $this->batteryCapacity = $batteryCapacity;
        $this->range = $range;
    }

    public function getBatteryCapacity() {
        return $this->batteryCapacity;
    }

    public function setBatteryCapacity($batteryCapacity) {
        $this->batteryCapacity = $batteryCapacity;
    }

    public function getRange() {
        return $this->range;
    }

    public function setRange($range) {
        $this->range = $range;
    }
}
?>
