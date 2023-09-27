<?php

namespace App\commands;

abstract class Command
{
    /**
     * @return void
     */
    abstract static function run(): void;
}
