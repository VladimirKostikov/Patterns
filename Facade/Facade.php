<?php

class SubsystemA
{
    public function operationA1()
    {
        return "SubsystemA: operationA1\n";
    }

    public function operationA2()
    {
        return "SubsystemA: operationA2\n";
    }
}

class SubsystemB
{
    public function operationB1()
    {
        return "SubsystemB: operationB1\n";
    }

    public function operationB2()
    {
        return "SubsystemB: operationB2\n";
    }
}

class SubsystemC
{
    public function operationC1()
    {
        return "SubsystemC: operationC1\n";
    }

    public function operationC2()
    {
        return "SubsystemC: operationC2\n";
    }
}

class Facade
{
    private $subsystemA;
    private $subsystemB;
    private $subsystemC;

    public function __construct()
    {
        $this->subsystemA = new SubsystemA();
        $this->subsystemB = new SubsystemB();
        $this->subsystemC = new SubsystemC();
    }

    public function simplifiedOperation()
    {
        $result = "";
        $result .= $this->subsystemA->operationA1();
        $result .= $this->subsystemB->operationB1();
        $result .= $this->subsystemC->operationC1();
        $result .= $this->subsystemA->operationA2();
        $result .= $this->subsystemB->operationB2();
        $result .= $this->subsystemC->operationC2();

        return $result;
    }
}

$facade = new Facade();
echo $facade->simplifiedOperation();

