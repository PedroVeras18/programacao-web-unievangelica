/*
* Curso de Engenharia de Software - UniEVANGÉLICA 
* Disciplina de Programação Web 
* Dev: Pedro Henrique Veras
* Data: 20/06/24
*/ 

<!-- Liskov Substitution Principle -->

<?php

function printCarDetails(Car $car) {
    echo $car->getMake() . " " . $car->getModel() . " (" . $car->getYear() . ")";
}

$car = new Car("Toyota", "Corolla", 2020);
$electricCar = new ElectricCar("Tesla", "Model S", 2021, 100);

printCarDetails($car);
printCarDetails($electricCar);
?>