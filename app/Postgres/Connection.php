<?php

namespace Postgreasy\Postgres;

class Connection extends \PDO
{
    /** @var string */
    private $host;

    /** @var string */
    private $username;

    /** @var string */
    private $password;

    /** @var string */
    private $schema;

    function __construct($host, $username, $password, $schema = null)
    {
        $this->host     = $host;
        $this->username = $username;
        $this->password = $password;
        $this->schema   = $schema;
        $dsn = "pgsql:host=$host";
        if ($schema) {
            $dsn .= " dbname=$schema";
        }
        parent::__construct($dsn, $username, $password);
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getSchema()
    {
        return $this->schema;
    }
}