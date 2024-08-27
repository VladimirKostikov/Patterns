<?php

interface Prototype
{
    public function clone(): Prototype;
}

class ApplicationForm implements Prototype
{
    private $name;
    private $fields;

    public function __construct(string $name, array $fields)
    {
        $this->name = $name;
        $this->fields = $fields;
    }
    public function clone(): Prototype
    {
        return new self($this->name, $this->fields);
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFields(): array
    {
        return $this->fields;
    }
}


$originalForm = new ApplicationForm('Job Application', ['Name', 'Position', 'Experience']);

$clonedForm = $originalForm->clone();

$clonedForm->setName('Internship Application');

echo "Original Form Name: " . $originalForm->getName() . "\n";
echo "Cloned Form Name: " . $clonedForm->getName() . "\n";
