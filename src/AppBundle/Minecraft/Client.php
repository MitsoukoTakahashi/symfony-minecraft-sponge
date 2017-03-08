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
use Http\Client\HttpAsyncClient;
use Http\Promise\Promise;
use JMS\Serializer\Serializer;
use Psr\Http\Message\ResponseInterface;

class Client
{
    private static $executor = 'Symfony API';
    private static $resource_info = 'info';
    private static $resource_chat = 'chat';
    private static $resource_command = 'cmd';
    private static $resource_player = 'player';
    private static $resource_world = 'world';
    private static $resource_plugin = 'plugin';
    private static $resource_entity = 'entity';
    private static $resource_tile_entity = 'tile-entity';

    private $httpClient;
    private $requestFactory;
    private $serializer;

    public function __construct(
        HttpAsyncClient $httpClient,
        RequestFactory $requestFactory,
        Serializer $serializer
    ) {
        $this->httpClient = $httpClient;
        $this->requestFactory = $requestFactory;
        $this->serializer = $serializer;
    }

    public function info(): Promise
    {
        return $this->promiseResponse(self::$resource_info, Info::class);
    }

    public function chat(): Promise
    {
        return $this->promiseResponse(self::$resource_chat, Chat::class);
    }

    public function commands(): Promise
    {
        return $this->promiseResponse(self::$resource_command, CommandList::class)
            ->then(function (CommandList $commandList) {
                return $commandList->getCommands();
            })
        ;
    }

    public function execute(string $command): Promise
    {
        return $this->httpClient
            ->sendAsyncRequest($this->requestFactory->createRequest(
                self::$resource_command,
                'POST',
                [
                    'name' => self::$executor,
                    'command' => $command,
                ]
            ))->then(function (ResponseInterface $response) {
                return $this->serializer
                    ->deserialize($response->getBody()->getContents(), CommandResponse::class, 'json');
            })
        ;
    }

    public function players(): Promise
    {
        return $this->promiseResponse(self::$resource_player, PlayerList::class)
            ->then(function (PlayerList $playerList) {
                return array_map(function(Player $player) {
                    return $this->pluginDetail($player->getUuid())->wait();
                }, $playerList->getPlayers());
            })
        ;
    }

    public function playerDetail(string $uuid, bool $raw = false): Promise
    {
        $resource = self::$resource_player.'/'.$uuid;

        return $this->promiseResponse($resource, Player::class, $raw);
    }

    public function worlds(): Promise
    {
        return $this->promiseResponse(self::$resource_world, WorldList::class)
            ->then(function (WorldList $worldList) {
                return array_map(function (World $world) {
                    return $this->worldDetail($world->getUuid())->wait();
                }, $worldList->getWorlds());
            })
        ;
    }

    public function worldDetail(string $uuid, bool $raw = false): Promise
    {
        $resource = self::$resource_world.'/'.$uuid;

        return $this->promiseResponse($resource, World::class, $raw);
    }

    public function plugins(): Promise
    {
        return $this->promiseResponse(self::$resource_plugin, PluginList::class)
            ->then(function (PluginList $pluginList) {
                return array_map(function (Plugin $plugin) {
                    return $this->pluginDetail($plugin->getId())->wait();
                }, $pluginList->getPlugins());
            })
        ;
    }

    public function pluginDetail(string $id, bool $raw = false): Promise
    {
        $resource = self::$resource_plugin.'/'.$id;

        return $this->promiseResponse($resource, Plugin::class, $raw);
    }

    public function entities(): Promise
    {
        return $this->promiseResponse(self::$resource_entity, EntityList::class)
            ->then(function(EntityList $entityList) {
                return array_map(function(Entity $entity) {
                    return $this->entityDetail($entity->getUuid())->wait();
                }, $entityList->getEntities());
            })
        ;
    }

    public function entityDetail(string $uuid, bool $raw = false): Promise
    {
        $resource = self::$resource_entity.'/'.$uuid;

        return $this->promiseResponse($resource, Entity::class, $raw);
    }

    public function tileEntities(): Promise
    {
        return $this->promiseResponse(self::$resource_tile_entity, TileEntityList::class)
            ->then(function (TileEntityList $tileEntityList) {
                return $tileEntityList->getTileEntities();
            })
        ;
    }

    public function tileEntityDetail(string $uuid, bool $raw = false): Promise
    {
        $resource = self::$resource_tile_entity . '/' . $uuid;

        return $this->promiseResponse($resource, TileEntity::class, $raw);
    }

    private function promiseResponse(string $resource, string $dto, bool $raw = false): Promise
    {
        if ($raw) {
            $resource .= '/raw';
        }

        return $this->httpClient
            ->sendAsyncRequest($this->requestFactory->createRequest($resource))
            ->then(function(ResponseInterface $response) use ($dto) {
                return $this->serializer->deserialize($response->getBody()->getContents(), $dto, 'json');
            })
        ;
    }
}
