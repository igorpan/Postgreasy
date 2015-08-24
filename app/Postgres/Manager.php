<?php

namespace Postgreasy\Postgres;

class Manager
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct($host, $username, $password)
    {
        $this->connection = new Connection($host, $username, $password);
    }

    /**
     * @return Schema[]
     */
    public function getSchemas()
    {
        $stmt = $this->connection->query('SELECT * FROM pg_database;');
        $stmt->execute();

        $result = $stmt->fetchAll();

        $schemas = [];
        foreach ($result as $row) {
            if ($row['datallowconn'] === true) {
                $schemas[] = new Schema($this->connection, $row['datname']);
            }
        }

        return $schemas;
    }
}