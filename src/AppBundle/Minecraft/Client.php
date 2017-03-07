<?php declare(strict_types = 1);

namespace AppBundle\Minecraft;

use AppBundle\Minecraft\Response\CommandList;
use AppBundle\Minecraft\Response\CommandResponse;
use AppBundle\Minecraft\Response\Entity;
use AppBundle\Minecraft\Response\EntityList;
use AppBundle\Minecraft\Response\TileEntity;
use AppBundle\Minecraft\Response\TileEntityList;
use AppBundle\Minecraft\Response\Info;
use AppBundle\Minecraft\Response\Chat;
use AppBundle\Minecraft\Response\Player;
use AppBundle\Minecraft\Response\PlayerList;
use AppBundle\Minecraft\Response\Plugin;
use AppBundle\Minecraft\Response\PluginList;
use AppBundle\Minecraft\Response\World;
use AppBundle\Minecraft\Response\WorldList;
use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Symfony\Component\Serializer\Serializer;

class Client
{
    const RESOURCE_INFO = 'info';
    const RESOURCE_CHAT = 'chat';
    const RESOURCE_COMMAND = 'cmd';
    const RESOURCE_PLAYER = 'player';
    const RESOURCE_WORLD = 'world';
    const RESOURCE_PLUGIN = 'plugin';
    const RESOURCE_ENTITY = 'entity';
    const RESOURCE_TILE_ENTITY = 'tile-entity';
    const RESOURCE_CLASS = 'class';

    private $httpClient;
    private $messageFactory;
    private $serializer;
    private $baseUrl;
    private $apiKey;

    public function __construct(
        HttpClient $httpClient,
        MessageFactory $messageFactory,
        Serializer $serializer,
        string $baseUrl,
        string $apiKey
    ) {
        $this->httpClient = $httpClient;
        $this->messageFactory = $messageFactory;
        $this->serializer = $serializer;
        $this->baseUrl = $baseUrl;
        $this->apiKey = $apiKey;
    }

    public function info(): Info
    {
        $response = $this->httpClient->sendRequest($this->createRequest(self::RESOURCE_INFO));

        return $this->serializer->deserialize($response->getBody()->getContents(), Info::class, 'json');
    }

    public function chat(): Chat
    {
        $response = $this->httpClient->sendRequest($this->createRequest(self::RESOURCE_CHAT));

        return $this->serializer->deserialize($response->getBody()->getContents(), Chat::class, 'json');
    }

    public function commands(): CommandList
    {
        $response = $this->httpClient->sendRequest($this->createRequest(self::RESOURCE_COMMAND));

        return $this->serializer->deserialize($response->getBody()->getContents(), CommandList::class, 'json');
    }

    public function execute(string $command)
    {
        $response = $this->httpClient
            ->sendRequest($this->createRequest(
                self::RESOURCE_COMMAND,
                'POST',
                [
                    'name' => 'Robin',
                    'command' => $command,
                ]
            ))
        ;

        return $this->serializer->deserialize($response->getBody()->getContents(), CommandResponse::class, 'json');
    }

    public function player(): PlayerList
    {
        $response = $this->httpClient->sendRequest($this->createRequest(self::RESOURCE_PLAYER));

        return $this->serializer->deserialize($response->getBody()->getContents(), PlayerList::class, 'json');
    }

    public function playerDetail(string $uuid, bool $raw = false)
    {
        $resource = self::RESOURCE_PLAYER.'/'.$uuid;
        if ($raw) {
            $resource .= '/raw';
        }

        $response = $this->httpClient->sendRequest($this->createRequest($resource));

        return $this->serializer->deserialize($response->getBody()->getContents(), Player::class, 'json');
    }

    public function world(): WorldList
    {
        $response = $this->httpClient->sendRequest($this->createRequest(self::RESOURCE_WORLD));

        return $this->serializer->deserialize($response->getBody()->getContents(), WorldList::class, 'json');
    }

    public function worldDetail(string $uuid, bool $raw = false): World
    {
        $resource = self::RESOURCE_PLAYER.'/'.$uuid;
        if ($raw) {
            $resource .= '/raw';
        }

        $response = $this->httpClient->sendRequest($this->createRequest($resource));

        return $this->serializer->deserialize($response->getBody()->getContents(), World::class, 'json');
    }

    public function plugin(): PluginList
    {
        $response = $this->httpClient->sendRequest($this->createRequest(self::RESOURCE_PLUGIN));

        return $this->serializer->deserialize($response->getBody()->getContents(), PluginList::class, 'json');
    }

    public function pluginDetail(string $id, bool $raw = false)
    {
        $resource = self::RESOURCE_PLUGIN.'/'.$id;
        if ($raw) {
            $resource .= '/raw';
        }

        $response = $this->httpClient->sendRequest($this->createRequest($resource));

        return $this->serializer->deserialize($response->getBody()->getContents(), Plugin::class, 'json');
    }

    public function entity(): EntityList
    {
        $response = $this->httpClient->sendRequest($this->createRequest(self::RESOURCE_ENTITY));

        return $this->serializer->deserialize($response->getBody()->getContents(), EntityList::class, 'json');
    }

    public function entityDetail(string $uuid, bool $raw = false): Entity
    {
        $resource = self::RESOURCE_ENTITY.'/'.$uuid;
        if ($raw) {
            $resource .= '/raw';
        }

        $response = $this->httpClient->sendRequest($this->createRequest($resource));

        return $this->serializer->deserialize($response->getBody()->getContents(), Entity::class, 'json');
    }

    public function tileEntity(): TileEntityList
    {
        $response = $this->httpClient->sendRequest($this->createRequest(self::RESOURCE_TILE_ENTITY));

        return $this->serializer->deserialize($response->getBody()->getContents(), TileEntityList::class, 'json');
    }

    public function tileEntityDetail(string $uuid, bool $raw = false): TileEntity
    {
        $resource = self::RESOURCE_TILE_ENTITY . '/' . $uuid;
        if ($raw) {
            $resource .= '/raw';
        }

        $response = $this->httpClient->sendRequest($this->createRequest($resource));

        return $this->serializer->deserialize($response->getBody()->getContents(), TileEntity::class, 'json');
    }

    private function createRequest(string $resource, string $method = 'GET', array $body = [])
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
