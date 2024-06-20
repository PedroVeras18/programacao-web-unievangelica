/*
* Curso de Engenharia de Software - UniEVANGÉLICA 
* Disciplina de Programação Web 
* Dev: Pedro Henrique Veras
* Data: 20/06/24
*/ 

<!-- Interface Segregation Principle -->

<?php

interface CarRepositoryInterface {
    public function save(Car $car);
    public function find($id);
    public function findAll();
    public function delete($id);
}
?>

<?php

require_once 'CarRepositoryInterface.php';

class CarRepository implements CarRepositoryInterface {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function save(Car $car) {
        if ($car->getId()) {
            // Update existing car
            $stmt = $this->db->prepare("UPDATE cars SET make = ?, model = ?, year = ? WHERE id = ?");
            $stmt->bind_param("sssi", $car->getMake(), $car->getModel(), $car->getYear(), $car->getId());
        } else {
            // Insert new car
            $stmt = $this->db->prepare("INSERT INTO cars (make, model, year) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $car->getMake(), $car->getModel(), $car->getYear());
        }
        $stmt->execute();
        if (!$car->getId()) {
            $car->setId($this->db->insert_id); // Set the ID of the new car
        }
        $stmt->close();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT id, make, model, year FROM cars WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id, $make, $model, $year);
        if ($stmt->fetch()) {
            $car = new Car($make, $model, $year);
            $car->setId($id);
        } else {
            $car = null; // Car not found
        }
        $stmt->close();
        return $car;
    }

    public function findAll() {
        $result = $this->db->query("SELECT id, make, model, year FROM cars");
        $cars = [];
        while ($row = $result->fetch_assoc()) {
            $car = new Car($row['make'], $row['model'], $row['year']);
            $car->setId($row['id']);
            $cars[] = $car;
        }
        return $cars;
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM cars WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}
?>

<?php

require_once 'ElectricCarRepositoryInterface.php';

class ElectricCarRepository implements ElectricCarRepositoryInterface {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function save(ElectricCar $car) {
        if ($car->getId()) {
            // Update existing electric car
            $stmt = $this->db->prepare("UPDATE electric_cars SET make = ?, model = ?, year = ?, battery_capacity = ?, range = ? WHERE id = ?");
            $stmt->bind_param("sssisi", $car->getMake(), $car->getModel(), $car->getYear(), $car->getBatteryCapacity(), $car->getRange(), $car->getId());
        } else {
            // Insert new electric car
            $stmt = $this->db->prepare("INSERT INTO electric_cars (make, model, year, battery_capacity, range) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssii", $car->getMake(), $car->getModel(), $car->getYear(), $car->getBatteryCapacity(), $car->getRange());
        }
        $stmt->execute();
        if (!$car->getId()) {
            $car->setId($this->db->insert_id); // Set the ID of the new electric car
        }
        $stmt->close();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT id, make, model, year, battery_capacity, range FROM electric_cars WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id, $make, $model, $year, $batteryCapacity, $range);
        if ($stmt->fetch()) {
            $car = new ElectricCar($make, $model, $year, $batteryCapacity, $range);
            $car->setId($id);
        } else {
            $car = null; // Electric car not found
        }
        $stmt->close();
        return $car;
    }

    public function findAll() {
        $result = $this->db->query("SELECT id, make, model, year, battery_capacity, range FROM electric_cars");
        $cars = [];
        while ($row = $result->fetch_assoc()) {
            $car = new ElectricCar($row['make'], $row['model'], $row['year'], $row['battery_capacity'], $row['range']);
            $car->setId($row['id']);
            $cars[] = $car;
        }
        return $cars;
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM electric_cars WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}
?>
