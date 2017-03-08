<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

use JMS\Serializer\Annotation as Serializer;

class Info
{
    /**
     * @Serializer\Type("string")
     */
    private $motd;

    /**
     * @Serializer\Type("int")
     */
    private $players;

    /**
     * @Serializer\Type("int")
     */
    private $maxPlayers;

    /**
     * @Serializer\Type("int")
     */
    private $uptimeTicks;

    /**
     * @Serializer\Type("bool")
     */
    private $hasWhitelist;

    /**
     * @Serializer\Type("string")
     */
    private $minecraftVersion;

    /**
     * @Serializer\Type("array")
     */
    private $api;

    public function getMotd()
    {
        return $this->motd;
    }

    public function getPlayers()
    {
        return $this->players;
    }

    public function getMaxPlayers()
    {
        return $this->maxPlayers;
    }

    public function getUptimeTicks()
    {
        return $this->uptimeTicks;
    }

    public function isHasWhitelist()
    {
        return $this->hasWhitelist;
    }

    public function getMinecraftVersion()
    {
        return $this->minecraftVersion;
    }

    public function getApi()
    {
        return $this->api;
    }
}
