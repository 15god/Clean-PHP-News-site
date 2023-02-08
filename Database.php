<?php

class Database {
    
    private $connection;
    public $queryStatus = FALSE;
    
    public function __construct($config, $username = 'root', $password = 12344321) {
        $dsn = 'mysql:' . http_build_query($config, '', ';');
        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);      
    }
    
    public function query($query,$params = []) {
        $stmt = $this->connection->prepare($query);
        $this->queryStatus = $stmt->execute($params);
        return $stmt;
    }
}