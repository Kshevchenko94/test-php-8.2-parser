<?php

namespace App\services\Interfaces;

interface SetDataInterface
{
    /**
     * @param string $table
     * @param array $data
     * @return bool
     */
    public function setData(string $table, array $data): bool;
}
