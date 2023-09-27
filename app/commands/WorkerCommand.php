<?php

namespace App\commands;

use App\services\AMQPService\AMPQConsumer;
use ErrorException;

final class WorkerCommand extends Command
{

    /**
     * @inheritDoc
     * @throws ErrorException
     */
    static function run(): void
    {
        global $config;
        $configRabbitmq = $config['rabbitmq'];

        (new AMPQConsumer(
            $configRabbitmq['host'],
            $configRabbitmq['port'],
            $configRabbitmq['user'],
            $configRabbitmq['password'],
            $configRabbitmq['channel'],
        ))->receivedMessage();

    }
}
