<?php

namespace Postgreasy\Postgres;

class Schema
{
    /**
     * @var Connection
     */
    private $connection;

    private $name;

    private $host;

    private $username;

    private $password;

    public function __construct(Connection $connection, $name)
    {
        $this->name = $name;
        $this->host = $connection->getHost();
        $this->username = $connection->getUsername();
        $this->password = $connection->getPassword();
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Table[]
     */
    public function getTables()
    {
        $stmt = $this->getConnection()->query("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'");
        $stmt->execute();
        
        $tables = [];
        foreach ($stmt->fetchAll() as $row) {
            $tables[] = new Table($this->connection, $row['table_name']);
        }
        return $tables;
    }

    private function getConnection()
    {
        if (null === $this->connection) {
            $this->connection = new Connection($this->host, $this->username, $this->password, $this->name);
        }
        return $this->connection;
    }
}