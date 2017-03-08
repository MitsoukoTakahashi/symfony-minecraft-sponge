<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

use JMS\Serializer\Annotation as Serializer;

class PlayerList
{
    /**
     * @Serializer\Type("array<AppBundle\Minecraft\Response\Player>")
     */
    private $players;

    /** @return Player[] */
    public function getPlayers()
    {
        return $this->players;
    }
}
