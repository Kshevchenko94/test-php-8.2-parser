<?php

namespace App\services\AMQPService;

use App\DTO\LengthContentDTO;
use App\models\LengthContentModel;
use ErrorException;

class AMPQConsumer extends AMQPService
{
    /**
     * @return void
     * @throws ErrorException
     */
    public function receivedMessage(): void
    {
        $callback = function ($msg) {
            $dto = new LengthContentDTO(
                $this->getContent($msg->body),
                date("Y-m-d H:i:s")
            );

            $model = new LengthContentModel();
            $model->saveData($dto);
            var_dump($msg->body);
            $msg->ack();
        };

        $this->channel->basic_consume(
            'delayed_queue',
            '',
            false,
            false,
            false,
            false,
            $callback
        );

        $this->channel->consume();
    }

    /**
     * @param string $url
     * @return int
     */
    private function getContent(string $url): int
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        curl_close($ch);
        return strlen($data);
    }
}
