<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

class Entity
{
    private $type;
    private $uuid;
    private $location;
    private $velocity;
    private $rotation;
    private $raw;

    public function __construct(
        string $type,
        string $uuid,
        array $location = [],
        array $velocity = [],
        array $rotation = [],
        array $raw = []
    ) {
        $this->type = $type;
        $this->uuid = $uuid;
        $this->location = $location;
        $this->velocity = $velocity;
        $this->rotation = $rotation;
        $this->raw = $raw;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getLocation(): array
    {
        return $this->location;
    }

    public function getVelocity(): array
    {
        return $this->velocity;
    }

    public function getRotation(): array
    {
        return $this->rotation;
    }

    public function getRaw(): array
    {
        return $this->raw;
    }
}
