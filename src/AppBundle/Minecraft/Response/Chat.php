<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

class Chat
{
    private $messages;

    /** @param Message[] $messages */
    public function __construct(array $messages)
    {
        $this->messages = array_map(function (array $message) {
            return new Message($message['date'], $message['sender'], $message['message']);
        }, $messages);
    }

    /** @return Message[] */
    public function getMessages(): array
    {
        return $this->messages;
    }
}
