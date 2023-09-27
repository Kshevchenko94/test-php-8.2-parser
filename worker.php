<?php

use App\commands\WorkerCommand;

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = include __DIR__ . '/app/config/config.php';

WorkerCommand::run();
