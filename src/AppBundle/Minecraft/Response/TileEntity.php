<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

class TileEntity
{
    private $type;
    private $location;
    private $raw;

    public function __construct(string $type, array $location, array $raw = [])
    {
        $this->type = $type;
        $this->location = $location;
        $this->raw = $raw;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getLocation(): array
    {
        return $this->location;
    }

    public function getRaw(): array
    {
        return $this->raw;
    }
}
