<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

class WorldList
{
    private $worlds;

    public function __construct(array $worlds)
    {
        $this->worlds = $worlds;
    }

    public function getWorlds(): array
    {
        return $this->worlds;
    }
}
