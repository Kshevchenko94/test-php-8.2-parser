<?php

namespace App\services\database;

use PDO;
use PDOException;

class Database
{
    /**
     * @var Database|null
     */
    protected static ?self $_instance = null;
    /**
     * @var PDO
     */
    private PDO $pdo;

    /**
     * @param string $host
     * @param int $port
     * @param string $dbName
     * @param string $user
     * @param string $password
     */
    private function __construct(
        private readonly string $host,
        private readonly int $port,
        private readonly string $dbName,
        private readonly string $user,
        private readonly string $password
    ) {
        try {
            $dsn = "mysql:dbname=$this->dbName;host=$this->host:$this->port";
            $this->pdo = new PDO($dsn, $this->user, $this->password);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    /**
     * @return void
     */
    private function __clone() {}

    /**
     * @return void
     */
    private function __wakeup() {}

    /**
     * @param string $host
     * @param int $port
     * @param string $dbname
     * @param string $user
     * @param string $password
     * @return self
     */
    public static function getInstance(
        string $host,
        int $port,
        string $dbname,
        string $user,
        string $password
    ): self
    {
        if (!self::$_instance) {
            self::$_instance = new self(
                $host,
                $port,
                $dbname,
                $user,
                $password
            );
        }

        return self::$_instance;
    }

    /**
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function select(string $sql, array $params): array
    {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($params);
        return $sth->fetchAll()?? [];
    }

    /**
     * @param string $sql
     * @param array $data
     * @return bool
     */
    public function insert(string $sql, array $data): bool
    {
        return $this->pdo->prepare($sql)->execute($data);
    }
}
