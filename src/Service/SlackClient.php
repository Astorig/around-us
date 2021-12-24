<?php

namespace App\Service;


use App\Helpers\LoggerTrait;
use Nexy\Slack\Client;

class SlackClient
{
    use LoggerTrait;

    /** @var Client */
    private $slack;

    public function __construct(Client $slack)
    {
        $this->slack = $slack;
    }
    
    public function send(string $message, string $from = 'Cat-Cas-Car')
    {
        $this->logInfo('Отправка сообщения в Slack', [
            'message' => $message
        ]);
    
        $this->slack->sendMessage(
            $this->slack
                ->createMessage()
                ->from($from)
                ->withIcon(':ghost:')
                ->setText($message)                
        );
    }
}
