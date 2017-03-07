<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

use Symfony\Component\OptionsResolver\OptionsResolver;

class Info
{
    private $motd;
    private $players;
    private $maxPlayers;
    private $uptimeTicks;
    private $hasWhitelist;
    private $minecraftVersion;
    private $api;

    public function __construct(
        string $motd,
        int $players,
        int $maxPlayers,
        int $uptimeTicks,
        bool $hasWhitelist,
        string $minecraftVersion,
        array $api
    ) {
        $this->motd = $motd;
        $this->players = $players;
        $this->maxPlayers = $maxPlayers;
        $this->uptimeTicks = $uptimeTicks;
        $this->hasWhitelist = $hasWhitelist;
        $this->minecraftVersion = $minecraftVersion;
        $this->api = $api;
    }

    public function getMotd(): string
    {
        return $this->motd;
    }

    public function getPlayers(): int
    {
        return $this->players;
    }

    public function getMaxPlayers(): int
    {
        return $this->maxPlayers;
    }

    public function getUptimeTicks(): int
    {
        return $this->uptimeTicks;
    }

    public function isHasWhitelist(): bool
    {
        return $this->hasWhitelist;
    }

    public function getMinecraftVersion(): string
    {
        return $this->minecraftVersion;
    }

    public function getApi(): array
    {
        return $this->api;
    }
}
