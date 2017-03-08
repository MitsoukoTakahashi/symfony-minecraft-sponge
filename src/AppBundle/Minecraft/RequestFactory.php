<?php declare(strict_types = 1);

namespace AppBundle\Minecraft;

use Http\Message\MessageFactory;
use Psr\Http\Message\RequestInterface;

class RequestFactory
{
    private $messageFactory;
    private $baseUrl;
    private $apiKey;

    public function __construct(MessageFactory $messageFactory, string $baseUrl, string $apiKey)
    {
        $this->messageFactory = $messageFactory;
        $this->baseUrl = $baseUrl;
        $this->apiKey = $apiKey;
    }

    public function createRequest(string $resource, string $method = 'GET', array $body = []): RequestInterface
    {
        $headers = [
            'content-type' => 'application/json',
            'x-webapi-key' => $this->apiKey,
        ];

        return $this->messageFactory
            ->createRequest(
                $method,
                $this->buildRequestUrl($resource),
                $headers,
                $this->buildBody($body)
            )
        ;
    }

    private function buildRequestUrl(string $resource): string
    {
        return rtrim($this->baseUrl, '/').'/'.$resource;
    }

    private function buildBody(array $body = [])
    {
        if (empty($body)) {
            return null;
        }

        return json_encode($body);
    }
}
