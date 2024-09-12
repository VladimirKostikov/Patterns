<?php

interface Element {
    public function accept(Visitor $visitor);
}


class ConcreteElementA implements Element {
    public function accept(Visitor $visitor) {
        $visitor->visitConcreteElementA($this);
    }

    public function operationA() {
        return "ConcreteElementA operation";
    }
}

class ConcreteElementB implements Element {
    public function accept(Visitor $visitor) {
        $visitor->visitConcreteElementB($this);
    }

    public function operationB() {
        return "ConcreteElementB operation";
    }
}


interface Visitor {
    public function visitConcreteElementA(ConcreteElementA $element);
    public function visitConcreteElementB(ConcreteElementB $element);
}


class ConcreteVisitor implements Visitor {
    public function visitConcreteElementA(ConcreteElementA $element) {
        echo "Visitor processing " . $element->operationA() . "<br>";
    }

    public function visitConcreteElementB(ConcreteElementB $element) {
        echo "Visitor processing " . $element->operationB() . "<br>";
    }
}


$elements = [new ConcreteElementA(), new ConcreteElementB()];
$visitor = new ConcreteVisitor();

foreach ($elements as $element) {
    $element->accept($visitor);
}
