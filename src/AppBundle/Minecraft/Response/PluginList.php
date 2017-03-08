<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

use JMS\Serializer\Annotation as Serializer;

class PluginList
{
    /**
     * @Serializer\Type("array<AppBundle\Minecraft\Response\Plugin>")
     */
    private $plugins;

    /** @return Plugin[] */
    public function getPlugins()
    {
        return $this->plugins;
    }
}
