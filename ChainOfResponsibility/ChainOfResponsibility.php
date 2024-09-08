<?php

interface Handler {
    public function setNext(Handler $handler): Handler;
    public function handle(string $request): ?string;
}

abstract class AbstractHandler implements Handler {
    private ?Handler $nextHandler = null;

    public function setNext(Handler $handler): Handler {
        $this->nextHandler = $handler;
        return $handler;  
    }

    public function handle(string $request): ?string {
        if ($this->nextHandler) {
            return $this->nextHandler->handle($request);
        }

        return null;
    }
}

class MonkeyHandler extends AbstractHandler {
    public function handle(string $request): ?string {
        if ($request === "Banana") {
            return "Monkey: I'll eat the " . $request . ".";
        } else {
            return parent::handle($request);
        }
    }
}

class SquirrelHandler extends AbstractHandler {
    public function handle(string $request): ?string {
        if ($request === "Nut") {
            return "Squirrel: I'll eat the " . $request . ".";
        } else {
            return parent::handle($request);
        }
    }
}

class DogHandler extends AbstractHandler {
    public function handle(string $request): ?string {
        if ($request === "Bone") {
            return "Dog: I'll eat the " . $request . ".";
        } else {
            return parent::handle($request);
        }
    }
}

function clientCode(Handler $handler) {
    $requests = ["Nut", "Banana", "Bone", "MeatBall"];

    foreach ($requests as $request) {
        $result = $handler->handle($request);
        if ($result) {
            echo $result . "\n";
        } else {
            echo $request . " was left untouched.\n";
        }
    }
}

$monkey = new MonkeyHandler();
$squirrel = new SquirrelHandler();
$dog = new DogHandler();

$monkey->setNext($squirrel)->setNext($dog);

echo "Chain: Monkey > Squirrel > Dog\n";
clientCode($monkey);

echo "\nChain: Squirrel > Dog\n";
clientCode($squirrel);