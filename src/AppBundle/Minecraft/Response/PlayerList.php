<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

class PlayerList
{
    private $players;

    public function __construct(array $players)
    {
        $this->players = array_map(function (array $player) {
            return new Player($player['name'], $player['uuid']);
        }, $players);
    }

    /** @return Player[] */
    public function getPlayers(): array
    {
        return $this->players;
    }
}
