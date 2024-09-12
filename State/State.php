<?php


interface State {
    public function handle(Context $context);
}


class ConcreteStateA implements State {
    public function handle(Context $context) {
        echo "Handling request in State A<br>";
        $context->setState(new ConcreteStateB());
    }
}

class ConcreteStateB implements State {
    public function handle(Context $context) {
        echo "Handling request in State B<br>";
        $context->setState(new ConcreteStateA());
    }
}


class Context {
    private $state;

    public function __construct(State $state) {
        $this->state = $state;
    }

    public function setState(State $state) {
        $this->state = $state;
    }

    public function request() {
        $this->state->handle($this);
    }
}


$context = new Context(new ConcreteStateA());

$context->request(); 
$context->request(); 
$context->request();
