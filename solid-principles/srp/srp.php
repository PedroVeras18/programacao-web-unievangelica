/*
* Curso de Engenharia de Software - UniEVANGÉLICA 
* Disciplina de Programação Web 
* Dev: Pedro Henrique Veras
* Data: 20/06/24
*/ 

<!-- Single Response Principle -->

<?php

class Car {
    private $id;
    private $make;
    private $model;
    private $year;

    public function __construct($make, $model, $year) {
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
    }

    // Getters and setters
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getMake() {
        return $this->make;
    }

    public function setMake($make) {
        $this->make = $make;
    }

    public function getModel() {
        return $this->model;
    }

    public function setModel($model) {
        $this->model = $model;
    }

    public function getYear() {
        return $this->year;
    }

    public function setYear($year) {
        $this->year = $year;
    }
}
?>

<?php

class CarRepository {
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
        $stmt->close();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT id, make, model, year FROM cars WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id, $make, $model, $year);
        $stmt->fetch();
        $car = new Car($make, $model, $year);
        $car->setId($id);
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
