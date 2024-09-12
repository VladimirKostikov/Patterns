<?php

interface Strategy {
    public function execute($a, $b);
}


class AdditionStrategy implements Strategy {
    public function execute($a, $b) {
        return $a + $b;
    }
}

class SubtractionStrategy implements Strategy {
    public function execute($a, $b) {
        return $a - $b;
    }
}

class MultiplicationStrategy implements Strategy {
    public function execute($a, $b) {
        return $a * $b;
    }
}

class Context {
    private $strategy;

    public function __construct(Strategy $strategy) {
        $this->strategy = $strategy;
    }

    public function setStrategy(Strategy $strategy) {
        $this->strategy = $strategy;
    }

    public function executeStrategy($a, $b) {
        return $this->strategy->execute($a, $b);
    }
}

// Example Usage
$context = new Context(new AdditionStrategy());
echo "Addition: " . $context->executeStrategy(10, 5) . "<br>"; 

$context->setStrategy(new SubtractionStrategy());
echo "Subtraction: " . $context->executeStrategy(10, 5) . "<br>"; 

$context->setStrategy(new MultiplicationStrategy());
echo "Multiplication: " . $context->executeStrategy(10, 5) . "<br>"; 