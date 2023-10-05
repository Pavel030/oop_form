<?php

namespace App\modules\model;

use App\modules\database\DatabaseConnection;

abstract class Model
{
    protected DatabaseConnection $database;

    public function __construct()
    {
        $this->database = DatabaseConnection::getInstance();
    }

    public function all(): array
    {
        $query = "SELECT * FROM " . $this->tableName;
        $result = $this->database->getConnection()->query($query);

        if ($result === false) {
            return [];
        }

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    public function pluck($columnName): array
    {
        $query = "SELECT $columnName FROM " . $this->tableName;
        $result = $this->database->getConnection()->query($query);

        $columnValues = [];
        while ($row = $result->fetch_assoc()) {
            $columnValues[] = $row[$columnName];
        }

        return $columnValues;
    }

    public function amount()
    {
        $query = "SELECT COUNT(*) as count FROM " . $this->tableName;
        $connection = $this->database->getConnection();
        $result = $connection->query($query);
        return $result->fetch_row()[0];
    }

    public function paginate($limit, $offset)
    {
        $query = "SELECT * FROM " . $this->tableName . " LIMIT $limit OFFSET $offset";
        $connection = $this->database->getConnection();
        $result = $connection->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}


