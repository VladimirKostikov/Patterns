<?php


interface Mediator {
    public function notify($sender, $event);
}


class ConcreteMediator implements Mediator {
    private $colleague1;
    private $colleague2;

    public function setColleague1(Colleague1 $colleague1) {
        $this->colleague1 = $colleague1;
    }

    public function setColleague2(Colleague2 $colleague2) {
        $this->colleague2 = $colleague2;
    }

    public function notify($sender, $event) {
        if ($sender === $this->colleague1 && $event === 'A') {
            echo "Mediator reacts on A and triggers following operations:<br>";
            $this->colleague2->doC();
        }

        if ($sender === $this->colleague2 && $event === 'B') {
            echo "Mediator reacts on B and triggers following operations:<br>";
            $this->colleague1->doA();
        }
    }
}


abstract class Colleague {
    protected $mediator;

    public function __construct(Mediator $mediator) {
        $this->mediator = $mediator;
    }
}


class Colleague1 extends Colleague {
    public function doA() {
        echo "Colleague1 does A.<br>";
        $this->mediator->notify($this, 'A');
    }
}

class Colleague2 extends Colleague {
    public function doB() {
        echo "Colleague2 does B.<br>";
        $this->mediator->notify($this, 'B');
    }

    public function doC() {
        echo "Colleague2 does C.<br>";
    }
}


$mediator = new ConcreteMediator();

$colleague1 = new Colleague1($mediator);
$colleague2 = new Colleague2($mediator);

$mediator->setColleague1($colleague1);
$mediator->setColleague2($colleague2);

$colleague1->doA();
$colleague2->doB();
