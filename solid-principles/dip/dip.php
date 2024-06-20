/*
* Curso de Engenharia de Software - UniEVANGÉLICA 
* Disciplina de Programação Web 
* Dev: Pedro Henrique Veras
* Data: 20/06/24
*/ 

<!-- Dependency Inversion Principle -->

<?php

interface DatabaseConnectionInterface {
    public function connect();
    // Outros métodos de conexão...
}
?>

<?php

require_once 'DatabaseConnectionInterface.php';

class MySQLConnection implements DatabaseConnectionInterface {
    private $connection;

    public function connect() {
        $this->connection = new mysqli("localhost", "user", "password", "car_database");
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function prepare($query) {
        return $this->connection->prepare($query);
    }

    public function query($query) {
        return $this->connection->query($query);
    }

    public function lastInsertId() {
        return $this->connection->insert_id;
    }
}
?>


<?php

require_once 'ElectricCarRepositoryInterface.php';
require_once 'DatabaseConnectionInterface.php';

class ElectricCarRepository implements ElectricCarRepositoryInterface {
    private $db;

    public function __construct(DatabaseConnectionInterface $db) {
        $this->db = $db;
        $this->db->connect();
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
            $car->setId($this->db->lastInsertId()); // Set the ID of the new electric car
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

<?php

require_once 'MySQLConnection.php';
require_once 'Car.php';
require_once 'ElectricCar.php';
require_once 'CarRepository.php';
require_once 'ElectricCarRepository.php';

$dbConnection = new MySQLConnection();

$carRepository = new CarRepository($dbConnection);
$electricCarRepository = new ElectricCarRepository($dbConnection);

// Create a new car
$newCar = new Car("Toyota", "Corolla", 2020);
$carRepository->save($newCar);

// Create a new electric car
$newElectricCar = new ElectricCar("Tesla", "Model S", 2021, 100, 400);
$electricCarRepository->save($newElectricCar);

// Find a regular car by ID
$foundCar = $carRepository->find($newCar->getId());
if ($foundCar instanceof Car) {
    echo "Found Car: " . $foundCar->getMake() . " " . $foundCar->getModel() . " (" . $foundCar->getYear() . ")<br>";
}

// Find an electric car by ID
$foundElectricCar = $electricCarRepository->find($newElectricCar->getId());
if ($foundElectricCar instanceof ElectricCar) {
    echo "Found Electric Car: " . $foundElectricCar->getMake() . " " . $foundElectricCar->getModel() . " (" . $foundElectricCar->getYear() . ") with battery capacity " . $foundElectricCar->getBatteryCapacity() . " kWh and range " . $foundElectricCar->getRange() . " km<br>";
}

$foundCar->setModel("Camry");
$carRepository->save($foundCar);

$foundElectricCar->setRange(450);
$electricCarRepository->save($foundElectricCar);

$carRepository->delete($newCar->getId());

$electricCarRepository->delete($newElectricCar->getId());

$cars = $carRepository->findAll();
foreach ($cars as $car) {
    echo "Car: " . $car->getMake() . " " . $car->getModel() . " (" . $car->getYear() . ")<br>";
}

$electricCars = $electricCarRepository->findAll();
foreach ($electricCars as $car) {
    echo "Electric Car: " . $car->getMake() . " " . $car->getModel() . " (" . $car->getYear() . ") with battery capacity " . $car->getBatteryCapacity() . " kWh and range " . $car->getRange() . " km<br>";
}
?>
