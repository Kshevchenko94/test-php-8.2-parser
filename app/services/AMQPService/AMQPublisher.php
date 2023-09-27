<?php

namespace App\services\AMQPService;

use Exception;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

class AMQPublisher extends AMQPService
{
    /**
     * @param string $message
     * @param int $delay
     * @return void
     * @throws Exception
     */
    public function publishMessage(string $message, int $delay = 0): void
    {
        if (!$message) {
            throw new Exception('The message is empty.');
        }

        $this->channel->queue_declare(
            queue: 'example_queue',
            durable: true,
            auto_delete: false
        );

        $this->channel->exchange_declare(
            exchange: 'example_exchange',
            type: 'x-delayed-message',
            durable: true,
            auto_delete: false,
            arguments: new AMQPTable(
                [
                    'x-delayed-type' => 'direct'
                ]
            )
        );

        $this->channel->queue_bind('example_queue', 'example_exchange');

        $message = new AMQPMessage('test', [
            'application_headers' => new AMQPTable(['x-delay' => 10000])
        ]);

        $this->channel->basic_publish($message, 'example_exchange');

    }
}
