<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

class Plugin
{
    private $id;
    private $name;
    private $description;
    private $version;
    private $url;
    private $authors;

    public function __construct(
        string $id,
        string $name,
        string $description = '',
        string $version = '',
        string $url = '',
        array $authors = []
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->version = $version;
        $this->url = $url;
        $this->authors = $authors;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getAuthors(): array
    {
        return $this->authors;
    }
}
