<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

class CommandList
{
    private $commands;

    public function __construct(array $commands)
    {
        $this->commands = array_map(function(array $command) {
            return new Command($command['name'], $command['aliases'], $command['usage'], $command['description']);
        }, $commands);
    }

    /** @return Command[] */
    public function getCommands(): array
    {
        return $this->commands;
    }
}
