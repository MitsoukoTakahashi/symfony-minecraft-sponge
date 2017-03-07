<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

class CommandResponse
{
    private $response;

    public function __construct(string $response)
    {
        $this->response = $response;
    }

    public function getResponse(): string
    {
        return $this->response;
    }
}
