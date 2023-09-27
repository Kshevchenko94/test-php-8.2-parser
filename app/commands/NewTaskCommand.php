<?php

namespace App\commands;

use App\enums\NewTaskCommandsEnum;
use App\services\AMQPService\AMQPublisher;
use App\services\TxtParser\TxtParser;
use Exception;

final class NewTaskCommand extends Command
{
    private const PATH_FILE = './URLs.txt';

    /**
     * @return void
     */
    public static function run(): void
    {
        global $config;
        $configRabbitmq = $config['rabbitmq'];

        foreach (self::getMessages() as $message) {
            try {
                (new AMQPublisher(
                    $configRabbitmq['host'],
                    $configRabbitmq['port'],
                    $configRabbitmq['user'],
                    $configRabbitmq['password'],
                    $configRabbitmq['channel'],
                ))->publishMessage(
                    $message,
                    NewTaskCommandsEnum::getDaly()
                );
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    /**
     * @return array
     */
    private static function getMessages(): array
    {
        try {
            return (new TxtParser(self::PATH_FILE))->parser();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
        }
    }
}
