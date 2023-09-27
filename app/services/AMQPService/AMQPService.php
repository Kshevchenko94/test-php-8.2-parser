<?php

namespace App\services\AMQPService;

use Exception;
use PhpAmqpLib\Channel\AbstractChannel;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exception\AMQPProtocolException;

abstract class AMQPService
{
    /**
     * @var AMQPStreamConnection
     */
    protected AMQPStreamConnection $connect;
    /**
     * @var AbstractChannel|AMQPChannel
     */
    protected AbstractChannel|AMQPChannel $channel;

    /**
     * @param string $host
     * @param int $port
     * @param string $username
     * @param string $password
     * @param string $queue
     */
    public function __construct(
        protected readonly string $host,
        protected readonly int $port,
        protected readonly string $username,
        protected readonly string $password,
        protected readonly string $queue
    )
    {
        try {
            $this->connect = new AMQPStreamConnection(
                $this->host,
                $this->port,
                $this->username,
                $this->password
            );

        } catch (AMQPProtocolException $exception) {
            echo $exception->getMessage();
        } catch (Exception $e) {
            echo $e->getMessage();
        }


    }

    /**
     * @throws Exception
     */
    public function __destruct()
    {
        $this->channel->close();
        $this->connect->close();
    }
}
