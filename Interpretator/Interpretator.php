<?php

interface Expression {
    public function interpret(array $context): int;
}


class Number implements Expression {
    private int $number;

    public function __construct(int $number) {
        $this->number = $number;
    }

    public function interpret(array $context): int {
        return $this->number;
    }
}


class Add implements Expression {
    private Expression $leftExpression;
    private Expression $rightExpression;

    public function __construct(Expression $left, Expression $right) {
        $this->leftExpression = $left;
        $this->rightExpression = $right;
    }

    public function interpret(array $context): int {
        return $this->leftExpression->interpret($context) + $this->rightExpression->interpret($context);
    }
}

class Subtract implements Expression {
    private Expression $leftExpression;
    private Expression $rightExpression;

    public function __construct(Expression $left, Expression $right) {
        $this->leftExpression = $left;
        $this->rightExpression = $right;
    }

    public function interpret(array $context): int {
        return $this->leftExpression->interpret($context) - $this->rightExpression->interpret($context);
    }
}


$expression = new Subtract(
    new Add(new Number(5), new Number(10)),
    new Add(new Number(2), new Number(3))
);


$result = $expression->interpret([]);

echo "Result: " . $result; 