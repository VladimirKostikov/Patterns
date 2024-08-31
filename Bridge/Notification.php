<?php
interface NotificationSender {
    public function send(string $message): void;
}


class EmailSender implements NotificationSender {
    public function send(string $message): void {
        echo "Sending email with message: $message\n";
    }
}

class SmsSender implements NotificationSender {
    public function send(string $message): void {
        echo "Sending SMS with message: $message\n";
    }
}

abstract class Notification {
    protected NotificationSender $sender;

    public function __construct(NotificationSender $sender) {
        $this->sender = $sender;
    }

    abstract public function send(string $message): void;
}

class UrgentNotification extends Notification {
    public function send(string $message): void {
        $message = "[URGENT] " . $message;
        $this->sender->send($message);
    }
}

class RegularNotification extends Notification {
    public function send(string $message): void {
        $this->sender->send($message);
    }
}

$emailSender = new EmailSender();
$smsSender = new SmsSender();

$urgentEmailNotification = new UrgentNotification($emailSender);
$regularSmsNotification = new RegularNotification($smsSender);

$urgentEmailNotification->send("Server is down!");
$regularSmsNotification->send("Your subscription will expire soon.");