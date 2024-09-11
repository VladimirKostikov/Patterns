<?php


class Memento {
    private $state;

    public function __construct($state) {
        $this->state = $state;
    }

    public function getState() {
        return $this->state;
    }
}


class Originator {
    private $state;

    public function setState($state) {
        echo "State set to: $state<br>";
        $this->state = $state;
    }

    public function saveStateToMemento() {
        return new Memento($this->state);
    }

    public function restoreStateFromMemento(Memento $memento) {
        $this->state = $memento->getState();
        echo "State restored to: $this->state<br>";
    }
}


class Caretaker {
    private $mementos = [];

    public function addMemento(Memento $memento) {
        $this->mementos[] = $memento;
    }

    public function getMemento($index) {
        return $this->mementos[$index];
    }
}


$originator = new Originator();
$caretaker = new Caretaker();


$originator->setState("State1");
$caretaker->addMemento($originator->saveStateToMemento());


$originator->setState("State2");
$caretaker->addMemento($originator->saveStateToMemento());

$originator->restoreStateFromMemento($caretaker->getMemento(0));
