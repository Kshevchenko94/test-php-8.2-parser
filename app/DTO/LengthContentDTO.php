<?php

namespace App\DTO;

use DateTime;

readonly class LengthContentDTO
{
    public function __construct(
        public int $lengthContent,
        public string $dateTime
    )
    {}
}
