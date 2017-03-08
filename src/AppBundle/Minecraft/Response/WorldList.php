<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

use JMS\Serializer\Annotation as Serializer;

class WorldList
{
    /**
     * @Serializer\Type("array<AppBundle\Minecraft\Response\World>")
     */
    private $worlds;

    /** @return World[] */
    public function getWorlds()
    {
        return $this->worlds;
    }
}
