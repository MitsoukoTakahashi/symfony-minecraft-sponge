<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

class Command
{
    private $name;
    private $aliases;
    private $usage;
    private $description;

    public function __construct(string $name, array $aliases, string $usage, string $description = null)
    {
        $this->name = $name;
        $this->aliases = $aliases;
        $this->usage = $usage;
        $this->description = $description;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAliases(): array
    {
        return $this->aliases;
    }

    public function getUsage(): string
    {
        return $this->usage;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
