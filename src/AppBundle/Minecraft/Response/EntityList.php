<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

use JMS\Serializer\Annotation as Serializer;

class EntityList
{
    /**
     * @Serializer\Type("array<AppBundle\Minecraft\Response\Entity>")
     */
    private $entities;

    /** @return Entity[] */
    public function getEntities()
    {
        return $this->entities;
    }
}
