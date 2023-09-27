<?php

namespace App\models;

use App\DTO\LengthContentDTO;
use App\services\ClickHouseService\ClickHouseService;
use App\services\MySQLService\MySQLService;

class LengthContentModel
{
    /**
     * @var MySQLService
     */
    protected MySQLService $mySQLService;

    /**
     * @var ClickHouseService
     */
    protected ClickHouseService $clickHouseService;

    public function __construct() {
        $this->mySQLService = new MySQLService();
        $this->clickHouseService = new ClickHouseService();
    }

    /**
     * @param LengthContentDTO $contentDTO
     * @return bool
     */
    public function saveData(LengthContentDTO $contentDTO): bool
    {
        return $this->mySQLService->setData(
            $this->getSqlInsertMariaDB(),
            [
                $contentDTO->dateTime,
                $contentDTO->lengthContent
            ]
        );
    }

    /**
     * @return array
     */
    public function getDataClickHouse(): array
    {
        return $this->clickHouseService->getData(
            $this->getSqlQueryMariaDB(),
            []
        );
    }

    /**
     * @return array
     */
    public function getDataMariDb(): array
    {
        return $this->mySQLService->getData(
            $this->getSqlQueryMariaDB(),
            []
        );
    }

    /**
     * @return string
     */
    private function getSqlQueryMariaDB(): string
    {
        return 'SELECT MINUTE(date_create), length_content FROM length_content_table GROUP BY MINUTE(date_create)';
    }

    /**
     * @return string
     */
    private function getSqlInsertMariaDB(): string
    {
        return 'INSERT INTO length_content_table(date_create, length_content) VALUES (?, ?)';
    }
}
