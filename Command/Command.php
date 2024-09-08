<?php

interface Command {
    public function execute(): void;
}

class TurnOnLightCommand implements Command {
    private $light;

    public function __construct(Light $light) {
        $this->light = $light;
    }

    public function execute(): void {
        $this->light->turnOn();
    }
}

class TurnOffLightCommand implements Command {
    private $light;

    public function __construct(Light $light) {
        $this->light = $light;
    }

    public function execute(): void {
        $this->light->turnOff();
    }
}


class Light {
    public function turnOn(): void {
        echo "The light is on\n";
    }

    public function turnOff(): void {
        echo "The light is off\n";
    }
}

class RemoteControl {
    private $command;

    public function setCommand(Command $command): void {
        $this->command = $command;
    }

    public function pressButton(): void {
        $this->command->execute();
    }
}


$light = new Light();

$turnOnCommand = new TurnOnLightCommand($light);
$turnOffCommand = new TurnOffLightCommand($light);

$remote = new RemoteControl();


$remote->setCommand($turnOnCommand);
$remote->pressButton();


$remote->setCommand($turnOffCommand);
$remote->pressButton();