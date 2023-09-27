<?php

namespace App\enums;

enum NewTaskCommandsEnum: int
{
    case STEP_FIRST = 10;
    case STEP_LAST = 100;
    case ONE_STEP = 1000;

    /**
     * @return int
     */
    public static function getDaly(): int
    {
        return rand(self::STEP_FIRST->value, self::STEP_LAST->value) * self::ONE_STEP->value;
    }
}
