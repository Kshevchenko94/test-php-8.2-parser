<?php

namespace App\services\Interfaces;

interface GetDataInterface
{
    /**
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function getData(string $sql, array $params): array;
}
