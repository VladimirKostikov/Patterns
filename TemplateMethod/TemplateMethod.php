<?php

abstract class AbstractTemplate {

    public function templateMethod() {
        $this->stepOne();
        $this->stepTwo();
        $this->stepThree();
    }

  
    protected function stepOne() {
        echo "Step One<br>";
    }

 
    abstract protected function stepTwo();
    abstract protected function stepThree();
}

class ConcreteClassA extends AbstractTemplate {
    protected function stepTwo() {
        echo "ConcreteClassA: Step Two<br>";
    }

    protected function stepThree() {
        echo "ConcreteClassA: Step Three<br>";
    }
}

class ConcreteClassB extends AbstractTemplate {
    protected function stepTwo() {
        echo "ConcreteClassB: Step Two<br>";
    }

    protected function stepThree() {
        echo "ConcreteClassB: Step Three<br>";
    }
}


$templateA = new ConcreteClassA();
$templateA->templateMethod();


$templateB = new ConcreteClassB();
$templateB->templateMethod();

