<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

class Player
{
    private $name;
    private $uuid;
    private $address;
    private $latency;
    private $location;
    private $velocity;
    private $rotation;
    private $raw;

    public function __construct(
        string $name,
        string $uuid,
        string $address = '',
        int $latency = 0,
        array $location = [],
        array $velocity = [],
        array $rotation = [],
        array $raw = []
    ) {
        $this->name = $name;
        $this->uuid = $uuid;
        $this->address = $address;
        $this->latency = $latency;
        $this->location = $location;
        $this->velocity = $velocity;
        $this->rotation = $rotation;
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

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getLatency(): int
    {
        return $this->latency;
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
