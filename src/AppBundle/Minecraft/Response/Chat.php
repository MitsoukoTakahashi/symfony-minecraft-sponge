<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

use JMS\Serializer\Annotation as Serializer;

class Chat
{
    /**
     * @Serializer\Type("array<AppBundle\Minecraft\Response\Message>")
     */
    private $messages;

    /** @return Message[] */
    public function getMessages()
    {
        return $this->messages;
    }
}
