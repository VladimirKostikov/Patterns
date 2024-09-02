<?php
interface Graphic {
    public function render(): void;
}
class Rectangle implements Graphic {
    public function render(): void {
        echo "Rendering a rectangle.\n";
    }
}

class Circle implements Graphic {
    public function render(): void {
        echo "Rendering a circle.\n";
    }
}

class CompositeGraphic implements Graphic {
    private array $children = [];

    public function add(Graphic $graphic): void {
        $this->children[] = $graphic;
    }

    public function remove(Graphic $graphic): void {
        $this->children = array_filter($this->children, function($child) use ($graphic) {
            return $child !== $graphic;
        });
    }

    public function render(): void {
        foreach ($this->children as $child) {
            $child->render();
        }
    }
}


$rectangle1 = new Rectangle();
$rectangle2 = new Rectangle();
$circle = new Circle();


$compositeGraphic = new CompositeGraphic();
$compositeGraphic->add($rectangle1);
$compositeGraphic->add($circle);


$anotherCompositeGraphic = new CompositeGraphic();
$anotherCompositeGraphic->add($compositeGraphic);
$anotherCompositeGraphic->add($rectangle2);


$anotherCompositeGraphic->render();
