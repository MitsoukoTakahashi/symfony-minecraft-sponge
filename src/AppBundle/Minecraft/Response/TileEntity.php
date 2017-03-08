<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

use JMS\Serializer\Annotation as Serializer;

class TileEntity
{
    /**
     * @Serializer\Type("string")
     */
    private $type;

    /**
     * @Serializer\Type("array")
     */
    private $location;

    /**
     * @Serializer\Type("array")
     */
    private $raw;

    public function getType()
    {
        return $this->type;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function getRaw()
    {
        return $this->raw;
    }
}
