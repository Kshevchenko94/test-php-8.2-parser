<?php

namespace App\services\MySQLService;

use App\services\database\Database;
use App\services\Interfaces\{
    GetDataInterface,
    SetDataInterface
};

class MySQLService
    implements
    GetDataInterface,
    SetDataInterface
{
    /**
     * @var Database
     */
    public Database $database;

    public function __construct()
    {

        global $config;

        $configMySQL = $config['databases']['mysql'];

        $this->database = Database::getInstance(
            $configMySQL['host'],
            $configMySQL['port'],
            $configMySQL['database'],
            $configMySQL['username'],
            $configMySQL['password'],
        );
    }

    /**
     * @inheritDoc
     */
    public function getData(string $sql, array $params): array
    {
        return $this->database->select($sql, $params);
    }

    /**
     * @inheritDoc
     */
    public function setData(string $table, array $data): bool
    {
        return $this->database->insert($table, $data);
    }
}
