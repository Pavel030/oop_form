<?php
namespace App\modules\database;

class DatabaseConnection
{
    private static ?self $instance = null;
    private static \mysqli $connection;

    private function __construct()
    {
        $config = ConfigLoader::loadDatabaseConfig();

        self::$connection = new \mysqli(
            $config['host'],
            $config['username'],
            $config['password'],
            $config['database']
        );
        self::$connection->set_charset($config['charset']);
        self::$connection->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);

        if (self::$connection->connect_error) {
            die("Database connection failed: " . self::$connection->connect_error);
        }
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection(): \mysqli
    {
        return self::$connection;
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
    }
}
