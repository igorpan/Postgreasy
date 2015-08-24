<?php

namespace Postgreasy\Postgres;

class Table
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var string
     */
    private $name;

    public function __construct(Connection $connection, $name)
    {
        $this->connection = $connection;
        $this->name = $name;
    }

    /**
     * @return Column[]
     */
    public function getColumns()
    {
        $sql = <<<SQL
SELECT * FROM information_schema.columns
WHERE table_catalog = '{$this->connection->getSchema()}'
AND table_schema = 'public'
AND table_name = '{$this->name}'
SQL;
        $stmt = $this->connection->query($sql);
        $stmt->execute();

        $columns = [];
        foreach ($stmt->fetchAll() as $row) {
            $columns[] = new Column($row['column_name']);
        }
        return $columns;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}