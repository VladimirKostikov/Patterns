<?php


// Abstract Factory
interface GUIFactory {
    // Method to create a Button
    public function createButton(): Button;
    
    // Method to create a Checkbox
    public function createCheckbox(): Checkbox;
}

// Concrete Factory 1 - creates Windows-style UI components
class WindowsFactory implements GUIFactory {
    public function createButton(): Button {
        return new WindowsButton();
    }

    public function createCheckbox(): Checkbox {
        return new WindowsCheckbox();
    }
}

// Concrete Factory 2 - creates MacOS-style UI components
class MacOSFactory implements GUIFactory {
    public function createButton(): Button {
        return new MacOSButton();
    }

    public function createCheckbox(): Checkbox {
        return new MacOSCheckbox();
    }
}


// Abstract Product - Checkbox
interface Checkbox {
    public function paint();
}

// Concrete Product - Windows Checkbox
class WindowsCheckbox implements Checkbox {
    public function paint() {
        echo "Render a checkbox in Windows style.\n";
    }
}

// Concrete Product - MacOS Checkbox
class MacOSCheckbox implements Checkbox {
    public function paint() {
        echo "Render a checkbox in MacOS style.\n";
    }
}


// Abstract Product - Button
interface Button {
    public function paint();
}

// Concrete Product - Windows Button
class WindowsButton implements Button {
    public function paint() {
        echo "Render a button in Windows style.\n";
    }
}

// Concrete Product - MacOS Button
class MacOSButton implements Button {
    public function paint() {
        echo "Render a button in MacOS style.\n";
    }
}


class Application {
    private $button;
    private $checkbox;

    // Constructor that receives a factory
    public function __construct(GUIFactory $factory) {
        $this->button = $factory->createButton();
        $this->checkbox = $factory->createCheckbox();
    }

    // Method to render UI components
    public function render() {
        $this->button->paint();
        $this->checkbox->paint();
    }
}


// Client selects the type of factory based on the operating system or environment
function clientCode() {
    // Let's say we're on a Windows platform
    $factory = new WindowsFactory();
    $app = new Application($factory);
    $app->render();

    // Output:
    // Render a button in Windows style.
    // Render a checkbox in Windows style.

    // For MacOS platform
    $factory = new MacOSFactory();
    $app = new Application($factory);
    $app->render();

    // Output:
    // Render a button in MacOS style.
    // Render a checkbox in MacOS style.
}

clientCode();