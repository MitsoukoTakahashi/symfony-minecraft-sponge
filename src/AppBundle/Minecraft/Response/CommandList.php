<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

use JMS\Serializer\Annotation as Serializer;

class CommandList
{
    /**
     * @Serializer\Type("array<AppBundle\Minecraft\Response\Command>")
     */
    private $commands;

    /** @return Command[] */
    public function getCommands()
    {
        return $this->commands;
    }
}
