<?php


interface DatabaseInterface {
    public function query(string $query): string;
}


class RealDatabase implements DatabaseInterface {
    public function __construct() {
        echo "Connecting to the real database...\n";
    }

    public function query(string $query): string {
        return "Executing query: '$query' on the real database.\n";
    }
}


class DatabaseProxy implements DatabaseInterface {
    private ?RealDatabase $realDatabase = null;
    private array $cache = [];

    public function query(string $query): string {

        if (isset($this->cache[$query])) {
            return "Returning cached result for query: '$query'.\n";
        }


        if ($this->realDatabase === null) {
            $this->realDatabase = new RealDatabase();
        }


        $result = $this->realDatabase->query($query);
        $this->cache[$query] = $result;

        return $result;
    }
}

// Клиентский код
function clientCode(DatabaseInterface $db) {
    echo $db->query("SELECT * FROM users");
    echo $db->query("SELECT * FROM users");  
    echo $db->query("SELECT * FROM orders");
}


echo "Using Proxy:\n";
$proxy = new DatabaseProxy();
clientCode($proxy);
