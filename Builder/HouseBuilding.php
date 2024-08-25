<?php

// Class representing a complex object - House
class House {
    private $walls;
    private $doors;
    private $windows;
    private $roof;
    private $garage;

    // Methods for setting house properties
    public function setWalls($walls) {
        $this->walls = $walls;
    }

    public function setDoors($doors) {
        $this->doors = $doors;
    }

    public function setWindows($windows) {
        $this->windows = $windows;
    }

    public function setRoof($roof) {
        $this->roof = $roof;
    }

    public function setGarage($garage) {
        $this->garage = $garage;
    }

    // Method to display house details
    public function showHouseDetails() {
        echo "House with {$this->walls} walls, {$this->doors} doors, {$this->windows} windows, a {$this->roof} roof";
        if ($this->garage) {
            echo ", and a garage.";
        } else {
            echo ".";
        }
        echo "\n";
    }
}

// Abstract builder - defines steps for building a house
abstract class HouseBuilder {
    protected $house;

    // Create a new House object
    public function createHouse() {
        $this->house = new House();
    }

    // Abstract methods to set house components
    abstract public function buildWalls();
    abstract public function buildDoors();
    abstract public function buildWindows();
    abstract public function buildRoof();
    abstract public function buildGarage();

    // Return the final House object
    public function getHouse(): House {
        return $this->house;
    }
}

// Concrete builder for a wooden house
class WoodenHouseBuilder extends HouseBuilder {
    public function buildWalls() {
        $this->house->setWalls("wooden");
    }

    public function buildDoors() {
        $this->house->setDoors("wooden");
    }

    public function buildWindows() {
        $this->house->setWindows("glass");
    }

    public function buildRoof() {
        $this->house->setRoof("shingle");
    }

    public function buildGarage() {
        $this->house->setGarage(false); // Wooden house without a garage
    }
}

// Concrete builder for a brick house
class BrickHouseBuilder extends HouseBuilder {
    public function buildWalls() {
        $this->house->setWalls("brick");
    }

    public function buildDoors() {
        $this->house->setDoors("metal");
    }

    public function buildWindows() {
        $this->house->setWindows("double-glazed");
    }

    public function buildRoof() {
        $this->house->setRoof("tile");
    }

    public function buildGarage() {
        $this->house->setGarage(true); // Brick house with a garage
    }
}

// Director class that manages the building process
class Director {
    private $builder;

    // Method to set the specific builder
    public function setBuilder(HouseBuilder $builder) {
        $this->builder = $builder;
    }

    // Method to construct a standard house
    public function buildStandardHouse() {
        $this->builder->createHouse();
        $this->builder->buildWalls();
        $this->builder->buildDoors();
        $this->builder->buildWindows();
        $this->builder->buildRoof();
        $this->builder->buildGarage();
    }
}

// Client code
$director = new Director();

// Build a wooden house
$woodenBuilder = new WoodenHouseBuilder();
$director->setBuilder($woodenBuilder);
$director->buildStandardHouse();
$woodenHouse = $woodenBuilder->getHouse();
$woodenHouse->showHouseDetails(); // Output: House with wooden walls, wooden doors, glass windows, a shingle roof.

// Build a brick house
$brickBuilder = new BrickHouseBuilder();
$director->setBuilder($brickBuilder);
$director->buildStandardHouse();
$brickHouse = $brickBuilder->getHouse();
$brickHouse->showHouseDetails(); // Output: House with brick walls, metal doors, double-glazed windows, a tile roof, and a garage.

?>
