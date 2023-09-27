<?php

namespace App\commands;

use App\services\AMQPService\AMPQConsumer;

final class WorkerCommand extends Command
{

    /**
     * @inheritDoc
     */
    static function run(): void
    {
        global $config;
        $configRabbitmq = $config['rabbitmq'];

        $res = (new AMPQConsumer(
            $configRabbitmq['host'],
            $configRabbitmq['port'],
            $configRabbitmq['user'],
            $configRabbitmq['password'],
            $configRabbitmq['channel'],
        ))->receivedMessage();

        echo "Received " . $res . "\n";
    }
}
