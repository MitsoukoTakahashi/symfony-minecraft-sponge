<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

class EntityList
{
    private $entities;

    public function __construct(array $entities)
    {
        $this->entities = array_map(function(array $entity) {
            return new Entity($entity['type'], $entity['uuid']);
        },$entities);
    }

    /** @return Entity[] */
    public function getEntities(): array
    {
        return $this->entities;
    }
}
