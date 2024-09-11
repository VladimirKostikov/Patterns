<?php
class MyCollection implements Iterator {
    private $items = [];
    private $position = 0;

    public function __construct($items) {
        $this->items = $items;
        $this->position = 0;
    }


    public function rewind() {
        $this->position = 0;
    }


    public function current() {
        return $this->items[$this->position];
    }


    public function key() {
        return $this->position;
    }


    public function next() {
        $this->position++;
    }

    public function valid() {
        return isset($this->items[$this->position]);
    }
}

// Пример использования:
$items = ['apple', 'banana', 'cherry'];
$collection = new MyCollection($items);

foreach ($collection as $key => $item) {
    echo "Key: $key; Value: $item\n";
}


class MyAggregateCollection implements IteratorAggregate {
    private $items = [];

    public function __construct($items) {
        $this->items = $items;
    }

    public function getIterator(): Traversable {
        return new ArrayIterator($this->items);
    }
}


$items = ['dog', 'cat', 'bird'];
$collection = new MyAggregateCollection($items);

foreach ($collection as $item) {
    echo $item . "\n";
}
