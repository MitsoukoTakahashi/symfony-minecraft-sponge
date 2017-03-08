<?php declare(strict_types = 1);

namespace AppBundle\Controller;

use AppBundle\Minecraft\Client;
use AppBundle\Minecraft\Response\Player;
use AppBundle\Minecraft\Response\PlayerList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

/** @Route(service="app.minecraft_controller", path="/minecraft") */
class MinecraftController
{
    private $client;
    private $templating;

    public function __construct(Client $client, EngineInterface $templating)
    {
        $this->client = $client;
        $this->templating = $templating;
    }

    /**
     * @Route(path="/info", name="minecraft_info", methods={"GET"})
     */
    public function infoAction()
    {
        return $this->templating->renderResponse('minecraft/info.html.twig', [
            'info' => $this->client->info()->wait(),
        ]);
    }

    /**
     * @Route(path="/command", name="minecraft_command", methods={"GET"})
     */
    public function commandAction()
    {
        return $this->templating->renderResponse('minecraft/command.html.twig', [
            'commands' => $this->client->commands()->wait(),
        ]);
    }

    /**
     * @Route(path="/players", name="minecraft_players", methods={"GET"})
     */
    public function playersAction()
    {
        return $this->templating->renderResponse('minecraft/players.html.twig', [
            'players' => $this->client
                ->players()
                ->then(function (PlayerList $playerList) {
                    return array_map(function(Player $player) {
                        return $this->client->pluginDetail($player->getUuid());
                    }, $playerList->getPlayers());
                })
                ->wait()
        ]);
    }
}
