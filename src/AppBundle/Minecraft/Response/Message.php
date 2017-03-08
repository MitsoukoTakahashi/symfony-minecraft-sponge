<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

use JMS\Serializer\Annotation as Serializer;

class Message
{
    /**
     * @Serializer\Type("string")
     */
    private $date;

    /**
     * @Serializer\Type("array")
     */
    private $sender;

    /**
     * @Serializer\Type("string")
     */
    private $message;

    public function getDate()
    {
        return $this->date;
    }

    public function getSender()
    {
        return $this->sender;
    }

    public function getMessage()
    {
        return $this->message;
    }
}
