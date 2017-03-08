<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

use JMS\Serializer\Annotation as Serializer;

class World
{
    /**
     * @Serializer\Type("string")
     */
    private $name;

    /**
     * @Serializer\Type("string")
     */
    private $uuid;

    /**
     * @Serializer\Type("array")
     */
    private $raw;

    public function getName()
    {
        return $this->name;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function getRaw()
    {
        return $this->raw;
    }
}
