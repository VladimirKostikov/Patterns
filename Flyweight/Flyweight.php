<?php


interface TextStyleFlyweight {
    public function render(string $text): void;
}


class ConcreteTextStyle implements TextStyleFlyweight {
    private string $font;
    private string $size;
    private string $color;

    public function __construct(string $font, string $size, string $color) {
        $this->font = $font;
        $this->size = $size;
        $this->color = $color;
    }

    public function render(string $text): void {
        echo "Rendering text: \"$text\" with font: $this->font, size: $this->size, color: $this->color<br>";
    }
}

class TextStyleFactory {
    private array $flyweights = [];


    public function getTextStyle(string $font, string $size, string $color): TextStyleFlyweight {
        $key = md5($font . $size . $color);
        
        if (!isset($this->flyweights[$key])) {
            $this->flyweights[$key] = new ConcreteTextStyle($font, $size, $color);
        }

        return $this->flyweights[$key];
    }

 
    public function getTotalFlyweights(): int {
        return count($this->flyweights);
    }
}


class Document {
    private TextStyleFactory $styleFactory;

    public function __construct(TextStyleFactory $styleFactory) {
        $this->styleFactory = $styleFactory;
    }

    public function addText(string $text, string $font, string $size, string $color): void {
        $textStyle = $this->styleFactory->getTextStyle($font, $size, $color);
        $textStyle->render($text);
    }
}


$styleFactory = new TextStyleFactory();

$document = new Document($styleFactory);
$document->addText('Hello World', 'Arial', '12px', 'black');
$document->addText('Flyweight Pattern', 'Arial', '12px', 'black');
$document->addText('PHP Example', 'Verdana', '14px', 'blue');

// Выводим количество созданных объектов Flyweight
echo "Total flyweights created: " . $styleFactory->getTotalFlyweights();

?>
