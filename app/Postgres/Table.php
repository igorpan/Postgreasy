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
            $columns[] = new Column($row['column_name'], $row['data_type']);
        }
        return $columns;
    }

    /**
     * @param int $offset
     * @param int $limit
     *
     * @return DataRow[]
     */
    public function getRows($offset, $limit)
    {
        $sql = "SELECT * FROM {$this->name} LIMIT {$limit} OFFSET {$offset}";

        $stmt = $this->connection->query($sql);
        $stmt->execute();

        $data = [];
        foreach ($stmt->fetchAll(\PDO::FETCH_ASSOC) as $row) {
            $data[] = new DataRow($row);
        }
        return $data;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}