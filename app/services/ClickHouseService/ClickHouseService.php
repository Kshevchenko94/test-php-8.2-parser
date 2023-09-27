<?php

namespace App\services\ClickHouseService;

use App\services\database\Database;
use App\services\Interfaces\GetDataInterface;

class ClickHouseService implements GetDataInterface
{
    /**
     * @var Database
     */
    public Database $database;

    public function __construct()
    {
        global $config;
        $configClickhouse = $config['databases']['clickhouse'];

        $this->database = Database::getInstance(
            $configClickhouse['host'],
            $configClickhouse['port'],
            $configClickhouse['database'],
            $configClickhouse['username'],
            $configClickhouse['password'],
        );
    }

    /**
     * @inheritDoc
     */
    public function getData(string $sql, array $params): array
    {
        return $this->database->select($sql, []);
    }
}
