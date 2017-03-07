<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

class World
{
    private $name;
    private $uuid;
    private $raw;

    public function __construct(string $name, string $uuid, array $raw = [])
    {
        $this->name = $name;
        $this->uuid = $uuid;
        $this->raw = $raw;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getRaw(): array
    {
        return $this->raw;
    }
}
