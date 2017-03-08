<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

use JMS\Serializer\Annotation as Serializer;

class Player
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
     * @Serializer\Type("string")
     */
    private $address;

    /**
     * @Serializer\Type("int")
     */
    private $latency;

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

    public function getName()
    {
        return $this->name;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getLatency()
    {
        return $this->latency;
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
