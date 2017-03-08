<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

use JMS\Serializer\Annotation as Serializer;

class Entity
{
    /**
     * @Serializer\Type("string")
     */
    private $type;

    /**
     * @Serializer\Type("string")
     */
    private $uuid;

    /**
     * @Serializer\Type("array")
     */
    private $location;

    /**
     * @Serializer\Type("array")
     */
    private $velocity;

    /**
     * @Serializer\Type("array")
     */
    private $rotation;

    /**
     * @Serializer\Type("array")
     */
    private $raw;

    public function getType()
    {
        return $this->type;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function getVelocity()
    {
        return $this->velocity;
    }

    public function getRotation()
    {
        return $this->rotation;
    }

    public function getRaw()
    {
        return $this->raw;
    }
}
