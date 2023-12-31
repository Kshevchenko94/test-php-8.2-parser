<?php

use App\commands\NewTaskCommand;

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = include __DIR__ . '/app/config/config.php';

NewTaskCommand::run();
