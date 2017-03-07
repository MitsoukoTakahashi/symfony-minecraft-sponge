<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

class Message
{
    private $timestamp;
    private $sender;
    private $message;

    public function __construct(int $timestamp, array $sender, string $message)
    {
        $this->timestamp = new \DateTime("@$timestamp");
        $this->sender = $sender;
        $this->message = $message;
    }

    public function getTimestamp(): \DateTime
    {
        return $this->timestamp;
    }

    public function getSender(): array
    {
        return $this->sender;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
