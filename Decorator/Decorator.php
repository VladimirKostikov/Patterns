<?php


interface Message
{
    public function getContent(): string;
}

class BasicMessage implements Message
{
    private $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}



abstract class MessageDecorator implements Message
{
    protected $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    abstract public function getContent(): string;
}

class UppercaseDecorator extends MessageDecorator
{
    public function getContent(): string
    {
        return strtoupper($this->message->getContent());
    }
}

class ExclamationDecorator extends MessageDecorator
{
    public function getContent(): string
    {
        return $this->message->getContent() . '!!!';
    }
}


$message = new BasicMessage("Hello, World");


$uppercaseMessage = new UppercaseDecorator($message);
$exclamationMessage = new ExclamationDecorator($uppercaseMessage);

echo $exclamationMessage->getContent();  