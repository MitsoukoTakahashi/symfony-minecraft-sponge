<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

class PluginList
{
    private $plugins;

    public function __construct(array $plugins)
    {
        $this->plugins = array_map(function (array $plugin) {
            return new Plugin($plugin['id'], $plugin['name']);
        }, $plugins);
    }

    /** @return Plugin[] */
    public function getPlugins(): array
    {
        return $this->plugins;
    }
}
